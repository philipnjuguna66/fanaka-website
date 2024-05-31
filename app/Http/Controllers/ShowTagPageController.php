<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Project;

class ShowTagPageController extends Controller
{
    public function __invoke(Tag $tag)
    {

        $whatsApp = Whatsapp::query()->inRandomOrder()->first();


        return view('pages.tags.archives', [
            'tag' => $tag,
            'whatsApp' => $whatsApp
        ]);


    }
}
