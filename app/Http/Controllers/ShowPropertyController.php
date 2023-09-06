<?php

namespace App\Http\Controllers;

use App\Models\Permalink;
use Illuminate\Support\Facades\Cache;

class ShowPropertyController extends Controller
{
    public function __invoke(Permalink $permalink)
    {
        $previewKey  =  $permalink->id;


        if (! Cache::has($previewKey))
        {
            Cache::increment(
                key: $previewKey,
            );
        }

        $views = Cache::get($previewKey, 1);


        return view('pages.property.single', [
            'page' => $permalink->linkable,
            'views'  => $views
        ]);
    }
}
