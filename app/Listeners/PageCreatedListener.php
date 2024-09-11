<?php

namespace App\Listeners;

use App\Events\PageCreatedEvent;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageCreatedListener
{
    public function handle(PageCreatedEvent $event): void
    {

        $key = Page::CACHE_KEY.".{$event->page->id}";

        $htmlKey = $key.".html";

        Cache::forget($key);
        Cache::forget($htmlKey);

        Cache::forever($key, $event->page->loadMissing('sections', 'link'));

        $html = view("layouts.cache.page")
            ->with(['page'=>  $event->page])
            ->render();


        Cache::forever($htmlKey, $html);


    }
}
