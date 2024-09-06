<?php

namespace App\Listeners;

use App\Events\BlogCreatedEvent;
use App\Models\Tag;
use Appsorigin\Plots\Models\Blog;
use Appsorigin\Plots\Models\Location;
use Appsorigin\Plots\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostCreatedListener
{
    public function handle(BlogCreatedEvent $event): void
    {

        /** @var Model<\Appsorigin\Blog\Models\Blog|Project|Location|Tag> $model */

        $model = $event->model;

        $key = $model::CACHE_KEY . ".{$model->id}";

        Cache::forget($key);

        Cache::forever($key, $event->model->loadMissing('link'));

        $htmlKey = $key . ".html";

        Cache::forget($htmlKey);

        if ($template = $model->link?->type?->cacheTemplate()) {
            $html = view($template)
                ->with([
                    'page' => $model,
                    'post' => $model,
                ])
                ->render();

            Cache::forever($htmlKey, $html);

        }


    }
}
