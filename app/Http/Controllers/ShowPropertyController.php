<?php

namespace App\Http\Controllers;

use App\Models\Permalink;
use App\Models\Whatsapp;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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


        $whatsApp = Whatsapp::query()
            ->whereIn('location_tags', $permalink->linkable?->branches->pluck('id')->toArray())
            ->pluck('phone_number')
            ->first();

        Log::info("whas", [$whatsApp]);


        return view('pages.property.single', [
            'page' => $permalink->linkable,
            'views'  => $views,
            'whatsApp' => $whatsApp
        ]);
    }
}
