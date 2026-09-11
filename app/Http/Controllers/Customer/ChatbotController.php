<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\ChatbotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    protected ChatbotService $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    /**
     * Nhận câu hỏi từ khách hàng và trả về câu trả lời tư vấn giày
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        $userMessage = $request->input('message');
        $reply = $this->chatbotService->generateReply($userMessage);

        return response()->json([
            'success' => true,
            'reply' => $reply,
        ]);
    }
}
