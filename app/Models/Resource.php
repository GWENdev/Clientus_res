<?php

namespace App\Models;

use Citco\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @property string $dueDate
 */
class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dueDate',
        'client_id',
        'paid_for',
        'subDays',

    ];


    public function client(): belongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    public function moveDate()  //берем дату в прошлом и прибавляем к ней число оплачиваемых месяцев
    {
        $now = Carbon::now();
        $paidFor = $this->paid_for;
        $newDueDay = $now->addMonths($paidFor);
        DB::table('resources')->where('id', $this->id)->update(['dueDate' => $newDueDay]);


    }



    public function isSubjectToAlarm(): bool //ищем даты в прошлом
    {
        $now = Carbon::now();
        $alarmDate = Carbon::parse($this->dueDate)->subDays((int)$this->subDays);
        return $now->greaterThan($alarmDate);

    }

    //send to telegram

    public function sendToTelegram($message)
    {
        $chatID = '-450105904';
        $apiToken = '755672542:AAG4mhD-3rylfphiCKM6uIWy3Dotf8XrKow';

        $url = "https://api.telegram.org/bot" . $apiToken . "/sendMessage";

        $postData['chat_id'] = $chatID;
        $postData['text'] = $message;


        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_exec($curl);

    }
}

 /*   public function checkDate() //проверяем приближение срока оплаты
    {
        $now = Carbon::now();
        $paymentDate = Carbon::parse($this->paid_day);

        $daysUntilPayment = $now->diffInDays($paymentDate, false);
        if ($daysUntilPayment <= 10 && $daysUntilPayment >= 0) {
            $alarm = 'У вас осталось {$daysUntilPayment} дней для оплаты "{$resource->resource_name}"';
            //доделать метод отправки сообщения
        }


    }

}*/


//$monthsToPay = $this->paid_for; // Получаем количество оплаченных месяцев из базы данных
//$paymentDate->addMonths($monthsToPay); // Добавляем количество оплаченных месяцев к дате оплаты
