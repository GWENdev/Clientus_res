<?php

namespace App\Console\Commands;

use App\Helpers\TelegramNotify;
use App\Models\Resource;
use Illuminate\Console\Command;

class ExpirationDateAlarmCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expiration-date-alarm-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = $this->withProgressBar( Resource::with('client')->get(),
            function (Resource $resource) {
                $expirationDate = $resource->dueDate->addMonths(intval($resource->paid_for));
                $daysRemaining = $expirationDate->diffInDays(now());

                if ($daysRemaining <= $resource->subDays) {
                    $message = sprintf(
                        'У %s не оплачен %s, до истечения срока осталось %d дней',
                        $resource->client->name,
                        $resource->name,
                        $daysRemaining
                    );
                    TelegramNotify::sendMessage($chat_id, $message);

                };
        });
        $chat_id = 'CHAT_ID';
        $resources = Resource::with('client')->get();

        foreach ($resources as $resource) {



        }
    }
}
