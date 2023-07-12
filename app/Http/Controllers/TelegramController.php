<?php

namespace App\Http\Controllers;

use Filament\Resources\Resource;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        $telegram = new Api(env('6367132246:AAEjVXUxU-EPw8XfPHRjBrJH2sCTRTZHOLg'));

        $resources = \App\Models\Resource::with('client_id')->get();

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
                    'chat_id' => $user->telegram_chat_id,
                    'text' => $message,
                ]);
            }
        }}
}