<?php

namespace App\Http\Controllers;

use App\Events\BlogCreatedEvent;
use App\Events\PageCreatedEvent;
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
        try {

            $key = $permalink->linkable::CACHE_KEY . ".{$permalink->linkable_id}";




            if (!Cache::has($key)) {


                    $key = $permalink->linkable::CACHE_KEY.".{$permalink->linkable_id}";

                    Cache::forget($key);

                    Cache::forever($key, $permalink->linkable->loadMissing('link'));

            }


            $page = $permalink->linkable;



            Log::info("Page", ['class' => get_class($page)]);

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
            else
            {
                $whatsApp = Whatsapp::query()->inRandomOrder()->first();
            }
            Log::info("Whatsapp", ['Whatsapp' => $whatsApp?->phone_number,'page' => $page->title]);


            return view($permalink->type->template(), [
                'page' => $page,
                'post' => $page,
                'whatsApp' => $whatsApp,
            ]);

        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return redirect('/');
        }
    }
}
