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

        if ($page instanceof Project) {
            $whatsApp = Whatsapp::query()
                ->whereJsonContains('location_tags', $page?->branches()?->pluck('location_id')->toArray())
                ->get();

            Log::info("whas", [$whatsApp,]);

        }


        return view($permalink->type->template(), [
            'page' => $page,
            'post' => $page,
        ]);

    }
}
