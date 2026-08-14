<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramWebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $chatId = $request->input('message.chat.id');

        Http::post(
            'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage',
            [
                'chat_id' => $chatId,
                'text' => 'Hello From Laravel',
            ]
        );

        return response()->json(['ok' => true]);
    }
}
