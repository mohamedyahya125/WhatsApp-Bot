<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class TelegramBotService
{
    public function handleMessage($update)
    {
        $chatId = $update['message']['chat']['id'];
        $messageText = $update['message']['text'];
        $firstName = $update['message']['chat']['first_name'];

        return [
            'chat' => $chatId,
            'message' => $messageText,
            'name' => $firstName,
        ];
    }
    public function processUserInput($chatId, $messageText, $firstName)
    {
        if ($messageText == 'حجز') {
            return 'نوع الحجز اي';
        } elseif ($messageText == 'مساعدة') {
            return 'ما نوع السماعدة';
        } else {
            return 'اختيار غير صحيح';
        }
    }
    public function sendMessage($chatId, $text)
    {
        $response = Http::post(
            "https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage",
            [
                'chat_id' => $chatId,
                'text' => $text,
            ]
        );

        \Log::info('Telegram Response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
    }
}
