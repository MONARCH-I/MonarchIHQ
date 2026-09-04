<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class MaiService
{
    private string $endpoint;
    private string $apiKey;
    private string $model;

    private string $schemaContext = <<<'SCHEMA'
You have access to a PostgreSQL database for MonarchI HQ — a technology company in Ghana.
The following tables exist:

TABLE: users — id, name, email, role (null=member|content_manager|store_manager|hr_manager|super_admin), is_super_admin, created_at
TABLE: categories — id, name
TABLE: products — id, category_id, name, slug, sku, price, sale_price, stock_quantity, min_stock_threshold, is_featured, is_active, badge_text, created_at
TABLE: orders — id, user_id, status (pending|processing|shipped|delivered|cancelled|completed), payment_status (pending|paid|failed|refunded), payment_channel (mobile_money|card), total, subtotal, shipping, currency, customer_name, customer_email, customer_phone, shipping_address, created_at
TABLE: order_items — id, order_id, product_id, quantity, price (unit price)
TABLE: contact_messages — id, name, email, subject, message, status (new|in_progress|replied|closed), hr_notes, replied_at, created_at
TABLE: job_listings — id, title, department, employment_type (full_time|part_time|contract|internship), location, is_active, created_at
TABLE: news_articles — id, title, slug, is_published, published_at, created_at
TABLE: portfolio_projects — id, title, slug, is_published, created_at
SCHEMA;

    public function __construct()
    {
        $this->apiKey   = config('services.gemini.key');
        $this->model    = config('services.gemini.model', 'gemini-2.5-flash');
        $this->endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";
    }

    /**
     * Main entry: processes a staff question and returns a rich structured response.
     *
     * @return array{reasoning: string, sql: string|null, results_count: int|null, results_preview: array|null, answer: string, error: string|null}
     */
    public function handle(string $question, User $user, array $history = []): array
    {
        // ── Step 1: Generate intent + SQL ───────────────────────────────────
        $queryResponse = $this->generateQuery($question, $user, $history);

        if (! $queryResponse['success']) {
            return [
                'reasoning'       => $queryResponse['reasoning'] ?? 'Failed to analyse the question.',
                'sql'             => null,
                'results_count'   => null,
                'results_preview' => null,
                'answer'          => 'I had trouble understanding your question. Could you try rephrasing it?',
                'error'           => $queryResponse['error'] ?? null,
            ];
        }

        $reasoning = $queryResponse['reasoning'];
        $sql       = $queryResponse['sql'] ?? null;
        $results   = null;
        $count     = null;

        // ── Step 2: Execute the SQL safely ──────────────────────────────────
        if ($sql) {
            $execResult = $this->executeQuery($sql);
            if ($execResult['success']) {
                $results = $execResult['rows'];
                $count   = count($results);
            } else {
                $reasoning .= "\n\n[SQL execution error: {$execResult['error']}]";
            }
        }

        // ── Step 3: Synthesise the answer ────────────────────────────────────
        $answerResponse = $this->generateAnswer($question, $reasoning, $sql, $results, $user, $history);

        return [
            'reasoning'       => $reasoning,
            'sql'             => $sql,
            'results_count'   => $count,
            'results_preview' => $results ? array_slice($results, 0, 20) : null,
            'answer'          => $answerResponse['answer'] ?? 'Unable to generate an answer. Please try again.',
            'error'           => null,
        ];
    }

    // ─── Private helpers ──────────────────────────────────────────────────────

    private function generateQuery(string $question, User $user, array $history): array
    {
        $systemPrompt = <<<PROMPT
You are MAI (Monarch AI), an internal AI assistant for MonarchI HQ staff managers.

{$this->schemaContext}

STAFF MEMBER: {$user->name} ({$user->roleLabel()})

RULES:
- Only generate SELECT queries — NEVER INSERT, UPDATE, DELETE, DROP, TRUNCATE, or ALTER.
- Always use LIMIT 100 max.
- If no DB data is needed for the question, set "sql" to null.
- Respond ONLY with valid JSON — no markdown fences, no other text.

JSON format:
{"reasoning": "<step-by-step thinking>", "sql": "<SELECT query or null>"}
PROMPT;

        $contents = $this->buildContents($history, $question);
        $response = $this->callGemini($contents, $systemPrompt);

        if (! $response['success']) {
            return ['success' => false, 'error' => $response['error'], 'reasoning' => ''];
        }

        $parsed = $this->parseJsonResponse($response['text']);

        if (! $parsed) {
            return ['success' => false, 'error' => 'Could not parse Gemini query response.', 'reasoning' => $response['text']];
        }

        $sql = null;
        if (isset($parsed['sql']) && $parsed['sql'] && $parsed['sql'] !== 'null') {
            $sql = trim($parsed['sql']);
        }

        return [
            'success'   => true,
            'reasoning' => $parsed['reasoning'] ?? '',
            'sql'       => $sql,
        ];
    }

    private function generateAnswer(string $question, string $reasoning, ?string $sql, ?array $results, User $user, array $history): array
    {
        if ($sql && $results !== null) {
            $rowCount       = count($results);
            $preview        = json_encode(array_slice($results, 0, 10), JSON_PRETTY_PRINT);
            $resultsContext = "Query returned {$rowCount} rows. First 10:\n{$preview}";
        } elseif ($sql) {
            $resultsContext = 'SQL query failed to execute.';
        } else {
            $resultsContext = 'No database query was needed.';
        }

        $firstName = explode(' ', $user->name)[0];

        $systemPrompt = <<<PROMPT
You are MAI (Monarch AI), a friendly internal AI assistant for MonarchI HQ.

MY REASONING:
{$reasoning}

SQL I RAN:
{$sql}

RESULTS:
{$resultsContext}

Synthesise a clear, direct, professional answer for {$firstName} using the results above.
- Use markdown formatting (bold, lists, tables) where it improves clarity.
- If results are empty, say so and suggest why.
- Do NOT expose raw table/column names unless asked.
- Respond ONLY with valid JSON: {"answer": "<markdown answer>"}
PROMPT;

        $contents = $this->buildContents($history, $question);
        $response = $this->callGemini($contents, $systemPrompt);

        if (! $response['success']) {
            return ['answer' => 'I retrieved the data but had trouble composing a response. Please try again.'];
        }

        $parsed = $this->parseJsonResponse($response['text']);
        return ['answer' => $parsed['answer'] ?? $response['text']];
    }

    /**
     * Execute SQL with strict safety checks — SELECT only.
     */
    private function executeQuery(string $sql): array
    {
        $normalised = strtoupper(trim(preg_replace('/\s+/', ' ', $sql)));

        $forbidden = ['INSERT', 'UPDATE', 'DELETE', 'DROP', 'TRUNCATE', 'ALTER', 'GRANT', 'REVOKE', 'EXEC', 'CREATE'];
        foreach ($forbidden as $kw) {
            // Check for keyword as a whole word
            if (preg_match('/\b' . $kw . '\b/', $normalised)) {
                return ['success' => false, 'rows' => null, 'error' => "Blocked: contains '{$kw}'. Only SELECT is allowed."];
            }
        }

        if (! preg_match('/^\s*SELECT\b/i', $sql)) {
            return ['success' => false, 'rows' => null, 'error' => 'Blocked: query must start with SELECT.'];
        }

        try {
            $rows = DB::select($sql);
            return ['success' => true, 'rows' => array_map(fn ($r) => (array) $r, $rows), 'error' => null];
        } catch (\Throwable $e) {
            return ['success' => false, 'rows' => null, 'error' => $e->getMessage()];
        }
    }

    private function callGemini(array $contents, string $systemPrompt): array
    {
        try {
            $payload = [
                'system_instruction' => ['parts' => [['text' => $systemPrompt]]],
                'contents'           => $contents,
                'generationConfig'   => ['temperature' => 0.2, 'maxOutputTokens' => 8192],
            ];

            $response = Http::timeout(30)->post($this->endpoint, $payload);

            if ($response->failed()) {
                return ['success' => false, 'error' => 'Gemini API error ' . $response->status(), 'text' => ''];
            }

            $text = $response->json('candidates.0.content.parts.0.text', '');
            return ['success' => true, 'text' => $text];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage(), 'text' => ''];
        }
    }

    private function buildContents(array $history, string $currentQuestion): array
    {
        $contents = [];
        foreach (array_slice($history, -10) as $msg) {
            $contents[] = [
                'role'  => $msg['role'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => $msg['content']]],
            ];
        }
        $contents[] = ['role' => 'user', 'parts' => [['text' => $currentQuestion]]];
        return $contents;
    }

    private function parseJsonResponse(string $text): ?array
    {
        // Strip markdown fences
        $text = preg_replace('/^```(?:json)?\s*/m', '', $text);
        $text = preg_replace('/\s*```\s*$/m', '', $text);
        $text = trim($text);

        $start = strpos($text, '{');
        $end   = strrpos($text, '}');
        if ($start === false || $end === false) {
            return null;
        }

        return json_decode(substr($text, $start, $end - $start + 1), true);
    }
}
