<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    public function webhook(TelegramBotService $telegram, Request $request)
    {
        $data = $request->all();
        $message = $telegram->handleMessage($data);
        $reply = $telegram->processUserInput(
            $message['chat'],
            $message['message'],
            $message['name']
        );
        $telegram->sendMessage($message['chat'], $reply);
        return response()->json([
            'messages' => 'تم بنجاح',
            'message' => $message,
            'reply' => $reply
        ], 201);
    }
}
