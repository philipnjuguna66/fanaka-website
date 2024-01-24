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




      dispatch(function (){

          $response = Http::get("https://amccopropertiesltd.co.ke/wp-json/wp/v2/posts?_embed&fields=id,title,content&per_page=100&page=2");

          if ($response->ok())
          {
              $data  = $response->object();

              foreach ($data as $pro) {

                  $url = ((array)$pro->_embedded)['wp:featuredmedia'][0]->source_url;

                  $contents = file_get_contents($url);
                  $featured_image = substr($url, strrpos($url, '/') + 1);

                  $path = "blogs". DIRECTORY_SEPARATOR. "featured". DIRECTORY_SEPARATOR . $featured_image;
                  Storage::disk('public')->put($path,  $contents, [
                      'visibility' => 'public'
                  ]);



                  $projectData = [
                      'title' => $pro->title->rendered,
                      'is_published' => true,
                      'body' => str($pro->content->rendered)->replace('<div>','')
                          ->replace('</div>', '')->toHtmlString(),
                      'meta_title' => $pro->title->rendered,
                      'meta_description' => str($pro->excerpt->rendered)->limit('156')->value(),
                      'featured_image' =>$path,
                      'type' => \App\Utils\Enums\BlogTypeEnum::POST,
                  ];






                  /** @var Blog $blog */
                  $blog = Blog::updateOrCreate([
                      'title' => $pro->title->rendered,
                  ], $projectData);


                  $blog->link()->delete();



                  $blog->link()->create([
                      'slug' => $pro->slug,
                      'type' => \App\Utils\Enums\PermerlinkTypeEnums::POST,
                  ]);

                  $blog->setCreatedAt(\Carbon\Carbon::parse($pro->modified));

                  $blog->saveQuietly();



                  event(new BlogCreatedEvent($blog));

              }



          }
          dump($response->json());

      })->onQueue('properties');




      dd('donw');

      $blogs = Blog::query()->latest('id')->cursor();


      $yourApiKey = env('OPEN_AI_API_KEY');


      foreach ($blogs as $blog) {
          $client = OpenAI::client($yourApiKey);

          $result = $client->completions()->create([
              'model' => 'text-davinci-003',
              'prompt' => 'correct errors and typos and the gramma without changing the wording'. $blog->body,
          ]);

          $blog->body = $result['choices'][0]['text'];


          $blog->save();


      }



  });
