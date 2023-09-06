  <?php

use App\Events\BlogCreatedEvent;
use Appsorigin\Plots\Models\Blog;
  use Appsorigin\Plots\Models\Project;
  use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', function () {


    foreach (Project::query()->with('link')->get() as $blog)
    {

        $blog->link?->delete();
        $blog->delete();

    }


    $http = Http::baseUrl('https://iconprime.co.ke/wp-json/wp/v2/');

    $pagesResponse = $http->get('posts?categories=30');


    if ($pagesResponse->successful()) {

        $pages = $pagesResponse->object();

        foreach ($pages as $page) {

            $featuredImage = $http->get('/media/'. $page->featured_media);

            $image = file_get_contents($featuredImage->json("source_url"));

            file_put_contents(public_path('storage/' . $featuredImage->json('slug') . '.jpg'), $image);



            try {

                $project = Project::updateOrCreate([
                    'name' => $page->title->rendered,
                ],[

                    'status' => \App\Utils\Enums\ProjectStatusEnum::FOR_SALE,
                    'price' => "500000",
                    'body' => str($page->content->rendered)->trim(),
                    'amenities' => str($page->content->rendered)->trim()->limit(1000),
                    'featured_image' =>  $featuredImage->json('slug') . '.jpg',
                    'video_path' => null,
                    'gallery' => null,
                    'map' => null,
                    'mutation' => null,
                    'meta_title' => $page->yoast_head_json->title,
                    'meta_description' =>  str($page->content->rendered)->trim()->limit(158)
                ]);

                $project->link()->create([
                    'slug' => $page->slug,
                    'type' => 'project',
                ]);

              /*  $blog = Blog::updateOrCreate([
                    'title' => $page->title->rendered,
                    ],[
                    'body' => $page->content->rendered,
                    'is_published' => true,
                    'meta_title' => $page->yoast_head_json->title,
                    'canonical' => $page->yoast_head_json->canonical,
                    'meta_description' => $page->yoast_head_json->og_description,
                    'featured_image' => 'posts/' . $page->slug . '.jpg',
                ]);*/

              /*  $blog->link()->delete();

                $blog->link()->create([
                    'type' => 'post',
                    'slug' => $page->slug,
                ]);

                event(new BlogCreatedEvent($blog));*/
            }
            catch (Exception $exception)
            {

                dd($exception);


            }
        }
    }
});
