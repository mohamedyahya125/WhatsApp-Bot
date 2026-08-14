<?php

namespace App\Services;

use App\Models\Service;
use App\Models\TelegramSession;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBotService
{
    protected string $botToken;
    protected string $apiUrl;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN', '');
        $this->apiUrl = "https://api.telegram.org/bot{$this->botToken}/";
    }

    public function handleWebhook(array $data): void
    {
        // 1. التعامل مع الضغط على الأزرار التفاعلية (Callback Query)
        if (isset($data['callback_query'])) {
            $this->handleCallbackQuery($data['callback_query']);
            return;
        }

        // 2. التعامل مع الرسائل النصية العادية
        if (isset($data['message'])) {
            $this->handleTextMessage($data['message']);
        }
    }

    protected function handleTextMessage(array $message): void
    {
        $chatId = $message['chat']['id'] ?? null;
        $text = trim($message['text'] ?? '');

        if (!$chatId) return;

        // جلب جلسة المستخدم أو إنشائها
        $session = TelegramSession::firstOrCreate(
            ['telegram_id' => $chatId],
            ['step' => 'START', 'data' => []]
        );

        if ($text === '/start' || $text === 'حجز' || $text === 'حجز جديد') {
            $this->showMainServices($chatId, $session);
        } else {
            $this->sendMessage($chatId, "أهلاً بك! لبدء حجز جديد يرجى إرسال كلمة *حجز* أو الضغط على /start");
        }
    }

    protected function showMainServices($chatId, TelegramSession $session): void
    {
        // جلب الخدمات المتاحة من جدول services عندك
        $services = Service::all();

        if ($services->isEmpty()) {
            $this->sendMessage($chatId, "عفواً، لا توجد خدمات متاح الحجز عليها حالياً.");
            return;
        }

        $buttons = [];
        foreach ($services as $service) {
            $buttons[] = [
                [
                    'text' => "🩺 {$service->name} (" . ($service->price ?? '') . " ج.م)",
                    'callback_data' => "select_service_{$service->id}"
                ]
            ];
        }

        // تحديث حالة المستخدم
        $session->update([
            'step' => 'CHOOSING_SERVICE',
            'data' => []
        ]);

        $this->sendMessageWithKeyboard($chatId, "مرحباً بك في نظام الحجز الآلي 🏥\nيرجى اختيار الخدمة المطلوبة:", $buttons);
    }

    protected function handleCallbackQuery(array $callbackQuery): void
    {
        $chatId = $callbackQuery['message']['chat']['id'] ?? null;
        $callbackData = $callbackQuery['data'] ?? '';
        $messageId = $callbackQuery['message']['message_id'] ?? null;

        if (!$chatId) return;

        $session = TelegramSession::where('telegram_id', $chatId)->first();

        // إغلاق مؤشر التحميل في تيليجرام على الزرار
        $this->answerCallbackQuery($callbackQuery['id']);

        if (str_starts_with($callbackData, 'select_service_')) {
            $serviceId = str_replace('select_service_', '', $callbackData);

            // حفظ الخدمة المختارة ونقل المستخدم للخطوة التالية
            $sessionData = $session->data ?? [];
            $sessionData['service_id'] = $serviceId;

            $session->update([
                'step' => 'CHOOSING_EMPLOYEE',
                'data' => $sessionData
            ]);

            $service = Service::find($serviceId);
            $serviceName = $service ? $service->name : 'الخدمة المختارة';

            $this->sendMessage($chatId, "تم اختيار: *{$serviceName}* ✅\n\nجارٍ إعداد خطوة اختيار الطبيب/الموظف...");
            // هنا سنربط اختيار الطبيب/الأخصائي المتاح لهذه الخدمة في الخطوة القادمة!
        }
    }

    public function sendMessage($chatId, string $text): void
    {
        Http::post($this->apiUrl . 'sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown',
        ]);
    }

    public function sendMessageWithKeyboard($chatId, string $text, array $inlineButtons): void
    {
        Http::post($this->apiUrl . 'sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown',
            'reply_markup' => [
                'inline_keyboard' => $inlineButtons
            ]
        ]);
    }

    protected function answerCallbackQuery($callbackQueryId): void
    {
        Http::post($this->apiUrl . 'answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
        ]);
    }
}
