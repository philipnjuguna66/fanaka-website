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


   return  (new \App\Utils\TelegramBot())
        ->sendMessage("New Lead from Facebook:in which area are you interested in making your investment? : kikuyu full name : sona by when do you plan to make your investment? : soon phone number : +254722721111 email : shahson@hotmail.com what budget are you working with? : a few million");
});
