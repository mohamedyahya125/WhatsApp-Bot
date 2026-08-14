<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // 👈 ضيف السطر ده فوق

class TelegramWebhookController extends Controller
{
    protected TelegramBotService $telegramBotService;

    public function __construct(TelegramBotService $telegramBotService)
    {
        $this->telegramBotService = $telegramBotService;
    }

    public function webhook(Request $request): JsonResponse
    {
        $data = $request->all();

        // 👈 تسجل البيانات اللي جاية عشان تتأكد إن تيليجرام بيوصل
        Log::info('Telegram Webhook Received:', $data);

        try {
            $this->telegramBotService->handleWebhook($data);
        } catch (\Throwable $e) {
            // 👈 لو حصل خطأ جوه الخدمة، سجل الخطأ من غير ما توقع الاستجابة
            Log::error('Telegram Service Error: ' . $e->getMessage());
        }

        // إرجاع 200 دائماً لتيليجرام
        return response()->json(['status' => 'success'], 200);
    }
}
