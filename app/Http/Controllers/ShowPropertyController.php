<?php

namespace App\Http\Controllers;

use App\Models\Permalink;
use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Project;
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

        $page = Cache::get($previewKey);

        $whatsApp = Whatsapp::query()->inRandomOrder()->first();

        if ($page instanceof Project) {

            $locationIds =  $page->branches()?->pluck('location_id')->toArray();

            $ids = [];

            foreach ($locationIds as $locationId) {

                $ids[] = "$locationId";
            }

            $whatsApp = Whatsapp::query()
                ->whereJsonContains('location_tags', $ids)
                ->first();

        }



        return view('pages.property.single', [
            'page' => $permalink->linkable,
            'views'  => $views,
            'whatsApp' => $whatsApp
        ]);
    }
}
