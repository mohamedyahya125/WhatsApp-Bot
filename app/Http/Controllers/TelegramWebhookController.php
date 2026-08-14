<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    public function webhook(TelegramBotService $telegram, Request $request)
    {
        $data = $request->all();

        $chatId = $data['message']['chat']['id'] ?? null;

        if ($chatId) {
            $telegram->sendMessage($chatId, 'اختبار البوت');
        }

        return response()->json([
            'ok' => true
        ]);
    }
}
