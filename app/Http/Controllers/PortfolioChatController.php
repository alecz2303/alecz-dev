<?php

namespace App\Http\Controllers;

use App\Services\PortfolioChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioChatController
{
    public function __invoke(Request $request, PortfolioChatService $chat): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:'.config('chatbot.max_message_length', 500)],
        ]);

        return response()->json($chat->reply($validated['message']));
    }
}
