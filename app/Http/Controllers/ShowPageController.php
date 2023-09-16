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
            ->whereIn('location_tags', $permalink->linkable?->branches->pluck('id')->toArray())
            ->pluck('phone_number')
            ->first();

        Log::info("whas", [$whatsApp]);



        return view($permalink->type->template(), [
            'page' => $page,
            'post' => $page,
        ]);

    }
}
