<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramBotController extends Controller
{
    private string $api_url;
    private string $token;
    public function __construct()
    {
        $this->token = '7639457882:AAHZCUzCAEDy4_9xZXvhaehZrO_xQaYUO2A';
        $this->api_url = "https://api.telegram.org/bot" . $this->token . "/";
    }
    public function index(Request $request)
    {
        $update = $request->all();

        if (isset($update['message'])) {
            // текст пользователя
            $text = $update['message']['text'];
            // тип чата
            $chat_type = $update['message']['chat']['type'];
            // айди пользователя
            $user_id = $update['message']['from']['id'];

            if ($chat_type == 'private') {
                $this->sendMessage($user_id, $text);
            }
        }
    }
    private function sendMessage($chat_id, $text): void
    {
        Http::post($this->api_url . "sendMessage", [
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }
}
