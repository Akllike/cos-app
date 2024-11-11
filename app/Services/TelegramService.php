<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected string $token;
    protected int $chatId;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
    }

    public function sendMessage(string $message): void
    {
        $response = Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
            'parse_mode' => 'markdown',
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        //return $response->json();
    }
}
