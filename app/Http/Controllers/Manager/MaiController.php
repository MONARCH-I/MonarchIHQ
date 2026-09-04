<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\MaiConversation;
use App\Models\MaiMessage;
use App\Services\MaiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaiController extends Controller
{
    public function __construct(private MaiService $mai) {}

    /**
     * Handle a chat message.
     * POST /manager/mai/chat
     */
    public function chat(Request $request): JsonResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'conversation_id' => ['nullable', 'integer', 'exists:mai_conversations,id'],
            'history' => ['nullable', 'array', 'max:20'],
            'history.*.role' => ['required', 'in:user,assistant'],
            'history.*.content' => ['required', 'string', 'max:4000'],
        ]);

        $user = auth()->user();
        $question = trim($request->input('message'));
        $history = $request->input('history', []);
        $convId = $request->input('conversation_id');

        // ── Resolve or create a conversation ────────────────────────
        if ($convId) {
            $conversation = MaiConversation::where('id', $convId)
                ->where('user_id', $user->id)
                ->firstOrFail();
        } else {
            // Auto-generate title from first message (truncated)
            $title = Str::limit($question, 60, '…');
            $conversation = MaiConversation::create([
                'user_id' => $user->id,
                'title' => $title,
            ]);
        }

        // ── Save the user message ────────────────────────────────────
        MaiMessage::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $question,
        ]);

        // ── Call the AI service ──────────────────────────────────────
        $result = $this->mai->handle($question, $user, $history);

        // ── Save the assistant response ──────────────────────────────
        MaiMessage::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'content' => $result['answer'],
            'reasoning' => $result['reasoning'],
            'sql' => $result['sql'],
            'results_count' => $result['results_count'],
            'results_preview' => $result['results_preview'],
        ]);

        return response()->json([
            'ok' => true,
            'conversation_id' => $conversation->id,
            'reasoning' => $result['reasoning'],
            'sql' => $result['sql'],
            'results_count' => $result['results_count'],
            'results_preview' => $result['results_preview'],
            'answer' => $result['answer'],
            'error' => $result['error'],
        ]);
    }

    /**
     * List all conversations for the current user.
     * GET /manager/mai/conversations
     */
    public function conversations(): JsonResponse
    {
        $convs = MaiConversation::where('user_id', auth()->id())
            ->latest('updated_at')
            ->take(50)
            ->get(['id', 'title', 'created_at', 'updated_at'])
            ->map(fn ($c) => [
                'id' => $c->id,
                'title' => $c->title,
                'created_at' => $c->created_at->diffForHumans(),
                'updated_at' => $c->updated_at->diffForHumans(),
            ]);

        return response()->json(['ok' => true, 'conversations' => $convs]);
    }

    /**
     * Load all messages for a given conversation.
     * GET /manager/mai/conversations/{conversation}
     */
    public function conversationMessages(MaiConversation $conversation): JsonResponse
    {
        // Ensure ownership
        abort_unless($conversation->user_id === auth()->id(), 403);

        $messages = $conversation->messages->map(fn ($m) => [
            'id' => $m->id,
            'role' => $m->role,
            'content' => $m->content,
            'reasoning' => $m->reasoning,
            'sql' => $m->sql,
            'results_count' => $m->results_count,
            'results_preview' => $m->results_preview,
            'created_at' => $m->created_at->format('H:i'),
            'date' => $m->created_at->diffForHumans(),
        ]);

        return response()->json([
            'ok' => true,
            'conversation_id' => $conversation->id,
            'title' => $conversation->title,
            'messages' => $messages,
        ]);
    }

    /**
     * Delete a conversation and all its messages.
     * DELETE /manager/mai/conversations/{conversation}
     */
    public function deleteConversation(MaiConversation $conversation): JsonResponse
    {
        abort_unless($conversation->user_id === auth()->id(), 403);
        $conversation->delete();

        return response()->json(['ok' => true]);
    }
}
