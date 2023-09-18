<?php

namespace App\Listeners;


use App\Events\LeadCreatedEvent;

use App\Utils\TelegramBot;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;



class LeadCreatedListener implements ShouldQueue
{
    use  InteractsWithQueue;


    /**
     * Handle the event.
     *
     * @param LeadCreatedEvent $event
     * @return void
     */
    public function handle(LeadCreatedEvent $event)
    {

        $response = Http::post('https://mis.fanaka.co.ke/api/notification', [
            'tel' => $event->phone,
            'branch' => $event->branch,
            'name' => $event->name,
            'message' => $event->message,
        ]);



        (new TelegramBot())->sendMessage($event->message);


    }


}
