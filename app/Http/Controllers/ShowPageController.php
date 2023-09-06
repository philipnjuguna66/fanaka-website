<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Permalink;
use Appsorigin\Plots\Models\Blog;
use Illuminate\Support\Facades\Cache;

class ShowPageController extends Controller
{
    public function __invoke(Permalink $permalink)
    {

        $key = $permalink->linkable::CACHE_KEY.".{$permalink->linkable_id}";

        $page = Cache::get($key);

        return view($permalink->type->template(), [
            'page' => $page,
            'post' => $page,
        ]);

    }
}
