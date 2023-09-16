<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Permalink;
use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Blog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ShowPageController extends Controller
{
    public function __invoke(Permalink $permalink)
    {

        $key = $permalink->linkable::CACHE_KEY.".{$permalink->linkable_id}";


        if (! Cache::has($key))
        {
            return  redirect('/');
        }


        $page = Cache::get($key);

        $whatsApp = Whatsapp::query()
            ->whereJsonContains('location_tags', $page?->has('branches')?->branches()?->pluck('location_id')->toArray())
            ->first();

        Log::info("whas", [$whatsApp, $page?->has('branches')?->branches()?->pluck('location_id')->toArray() ]);



        return view($permalink->type->template(), [
            'page' => $page,
            'post' => $page,
        ]);

    }
}
