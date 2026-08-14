<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    protected TelegramBotService $telegramBotService;

    public function __construct(TelegramBotService $telegramBotService)
    {
        $this->telegramBotService = $telegramBotService;
    }

    /**
     * استلام الـ Webhook من تليجرام
     */
    public function webhook(Request $request): JsonResponse
    {
        $data = $request->all();

        // تمرير البيانات للخدمة لمعالجتها
        $this->telegramBotService->handleWebhook($data);

        // تليجرام يتوقع دائمًا استجابة 200 OK
        return response()->json(['status' => 'success'], 200);
    }
}
