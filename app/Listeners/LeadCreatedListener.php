<?php

namespace App\Listeners;


use App\Events\LeadCreatedEvent;
use App\Utils\Services\SMS\SendSms;
use App\Utils\Services\Telegram\TelegramBoot;
use App\Utils\TelegramBot;
use Appsorigin\Leads\Models\Lead;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


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
        $lead  = $event->lead;

        $response = Http::post('https://mis.fanaka.co.ke/api/notification', [
            'tel' => $event->phone,
            'branch' => $event->branch,
            'name' => $lead->name,
            'message' => $event->message,
            'title' => $lead->page
        ]);


        if(! $response->successful())
        {
            Log::info("error" , [$response->json()]);
        }



        (new TelegramBot())->sendMessage($event->message);


    }


}
