<?php

namespace App\Http\Controllers;

use App\Models\Resource;

class TelegramController extends Controller
{
    public function sendMessage($chatId, $message)
    {
        $botToken = 'TELEGRAM_BOT_TOKEN';


    }


}


        /* public function handle(Request $request)
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $resources = Resource::with('client_id')->get();

        foreach ($resources as $resource) {
            $expirationDate = $resource->dueDate->addMonths($resource->paid_for);
            $daysRemaining = $expirationDate->diffInDays(now());

            if ($daysRemaining <= $resource->subDays) {
                $message = sprintf(
                    'У %s не оплачен %s, до истечения срока осталось %d дней',
                    $resource->client->name,
                    $resource->name,
                    $daysRemaining
                );

                $telegram->sendMessage([
                    'chat_id' => $telegram_chat_id,
                    'text' => $message
                ]);
            }
        }} */
