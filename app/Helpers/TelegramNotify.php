<?php

namespace App\Helpers;

class TelegramNotify
{
    public static function sendMessage(string $chat_id, string $message)
    {
        $curl = curl_init();
        $botToken = 'TELEGRAM_BOT_TOKEN';
        $chat_id = 'CHAT_ID';
        curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.telegram.org/bot$botToken/sendMessage",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => $chat_id,
                    'text' => $message
                ))
        );
        $response = curl_exec($curl);
        curl_close($curl);

    }

}