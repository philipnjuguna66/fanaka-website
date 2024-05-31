<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Location;

class ShowLocationPageController extends Controller
{
    public function __invoke(Location $branch)
    {


        $whatsApp = Whatsapp::query()->inRandomOrder()->first();


        return view('pages.locations.archives', [
                'branch' => $branch ,
            'whatsApp'  => $whatsApp
            ]);


    }
}
