<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Permalink;
use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Blog;
use Appsorigin\Plots\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ShowPageController extends Controller
{
    public function __invoke(Permalink $permalink)
    {

        $key = $permalink->linkable::CACHE_KEY . ".{$permalink->linkable_id}";


        if (!Cache::has($key)) {
            return redirect('/');
        }


        $page = Cache::get($key);

        $whatsApp = Whatsapp::query()->inRandomOrder()->pluck('phone_number')->first();

        if ($page instanceof Project) {

            $locationIds =  $page->branches()?->pluck('location_id')->toArray();

            $whatsApp = Whatsapp::query()
                ->whereIn('location_tags', $locationIds)
                ->pluck('phone_number')
                ->first();

            Log::info('whats', [$locationIds]);

        }


        return view($permalink->type->template(), [
            'page' => $page,
            'post' => $page,
            'whatsApp' => $whatsApp,
        ]);

    }
}
