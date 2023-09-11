<?php

use App\Http\Controllers\ShowLocationPageController;
use App\Http\Controllers\ShowPageController;
use App\Http\Controllers\ShowPropertyController;
use App\Imports\PropertiesImport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $page = \App\Models\Page::query()->with('sections', 'link')->where('is_front_page', true)->firstOrFail();

    return view('welcome')->with(['page' => $page]);
})->name('home.page');

Route::get('test', function (){

    $links = \App\Models\Permalink::query()->with('linkable')->get();


    foreach ($links as $link) {

        if (! isset($link->linkable->id))
        {
           $link->delete();
        }
    }




    try {
        \Appsorigin\Blog\Models\Blog::query()->delete();

        Excel::import(new PropertiesImport(), public_path('posts.xlsx'));

        return "success";

    }
    catch (Exception $e)
    {
        dd($e->getMessage());
    }
});

Route::redirect('/property','/properties-for-sale');

Route::get('location/{branch:slug}', ShowLocationPageController::class)->name('permalink.location.show');
Route::get('tag/{branch:slug}', ShowLocationPageController::class);
Route::get('property/{permalink:slug}', ShowPageController::class)->name('permalink.property.show');
Route::get('/{permalink:slug}', ShowPageController::class)->name('permalink.show');
