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

    /**
     * Отправка сообщения в чат с ботом
     *
     * @param string $message Сообщение
     * @return void
     */
    public function sendMessage(string $message): void
    {
        $response = Http::post('https://api.telegram.org/bot' . $this->token . '/sendMessage', [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);
    }
}
