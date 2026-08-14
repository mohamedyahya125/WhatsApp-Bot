<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    public function webhook(Request $request)
    {
        return response()->json([
            'token_exists' => env('TELEGRAM_BOT_TOKEN'),
            'data' => $request->all()
        ]);
    }
}
