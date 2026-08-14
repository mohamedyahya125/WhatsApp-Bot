<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Telegram Update', $request->all());

        return response()->json([
            'ok' => true
        ]);
    }
}
