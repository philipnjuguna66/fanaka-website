<?php

use App\Http\Controllers\ShowLocationPageController;
use App\Http\Controllers\ShowPageController;
use App\Http\Controllers\ShowPropertyController;
use App\Http\Controllers\ShowTagPageController;
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

Route::get('test', function (\App\Utils\Services\ShortcodeService $service){


    abort_if(app()->isProduction(), 403);
    $content = 'Your content with ["project:1, take:1"] shortcode';

    $processedContent = $service->replaceShortcodes($content);

    $page = \Appsorigin\Blog\Models\Blog::query()->first();

    $page->body = str($processedContent)->append($page->body)->toHtmlString();

    $page->save();


    return view('pages.post.single', [
        'post' => $page,
    ]);


    dd(str($processedContent)->toHtmlString() , "=> Reso");



});

Route::get('/', function () {
    $page = \App\Models\Page::query()->with('sections', 'link')->where('is_front_page', true)->firstOrFail();

    return view('welcome')->with(['page' => $page,
        'whatsApp' => "254700111172"]);
})->name('home.page');


Route::redirect('/property', '/properties-for-sale');


Route::get('/search', function (\Illuminate\Http\Request $request){

    $searchTerm = $request->query('query');


    return redirect(url('/property?query='.$searchTerm));


})->name('search');

Route::get('location/{branch:slug}', ShowLocationPageController::class)->name('permalink.location.show');
Route::get('tag/{tag:slug}', ShowTagPageController::class)->name('permalink.tag.show');
Route::get('property/{permalink:slug}', ShowPageController::class)->name('permalink.property.show');
Route::get('/{permalink:slug}', ShowPageController::class)->name('permalink.show');

Route::fallback(function () {
    $page = \App\Models\Page::query()->with('sections', 'link')->where('is_front_page', true)->firstOrFail();

    return view('welcome')->with(['page' => $page,
        'whatsApp' => "254700111172"]);
});
