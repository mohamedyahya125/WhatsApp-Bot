<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBotService
{
    protected string $botToken;
    protected string $apiUrl;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token', env('TELEGRAM_BOT_TOKEN', ''));
        $this->apiUrl = "https://api.telegram.org/bot{$this->botToken}";
    }

    /**
     * معالجة الـ Update القادم من تليجرام
     */
    public function handleWebhook(array $update): void
    {
        Log::info('Telegram Webhook Received:', $update);

        if (!isset($update['message'])) {
            return;
        }

        $message = $update['message'];
        $chatId = $message['chat']['id'] ?? null;
        $text = $message['text'] ?? '';

        if (!$chatId) {
            return;
        }

        // تجربة رد تلقائي
        if ($text === '/start') {
            $this->sendMessage($chatId, "أهلاً بك في البوت! 👋");
        } else {
            $this->sendMessage($chatId, "وصلت رسالتك: {$text}");
        }
    }

    /**
     * إرسال رسالة للمستخدم عبر API تليجرام
     */
    public function sendMessage(mixed $chatId, string $text): bool
    {
        if (empty($this->botToken)) {
            Log::error('Telegram Bot Token is missing!');
            return false;
        }

        $response = Http::post("{$this->apiUrl}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        return $response->successful();
    }
}
