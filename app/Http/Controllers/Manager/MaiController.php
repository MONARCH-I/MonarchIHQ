<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Services\MaiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaiController extends Controller
{
    public function __construct(private MaiService $mai) {}

    /**
     * Handle a chat message from a manager.
     * POST /manager/mai/chat
     */
    public function chat(Request $request): JsonResponse
    {
        $request->validate([
            'message'         => ['required', 'string', 'max:2000'],
            'history'         => ['nullable', 'array', 'max:20'],
            'history.*.role'  => ['required', 'in:user,assistant'],
            'history.*.content' => ['required', 'string', 'max:4000'],
        ]);

        $user     = auth()->user();
        $question = trim($request->input('message'));
        $history  = $request->input('history', []);

        $result = $this->mai->handle($question, $user, $history);

        return response()->json([
            'ok'              => true,
            'reasoning'       => $result['reasoning'],
            'sql'             => $result['sql'],
            'results_count'   => $result['results_count'],
            'results_preview' => $result['results_preview'],
            'answer'          => $result['answer'],
            'error'           => $result['error'],
        ]);
    }
}
