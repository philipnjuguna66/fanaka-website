<?php

namespace App\Imports;


use App\Events\BlogCreatedEvent;
use Appsorigin\Blog\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;


class PropertiesImport implements ToCollection, WithHeadingRow, WithProgressBar
{
    use Importable;

    public function collection(Collection $blogs)
    {
        try {
            DB::beginTransaction();


            foreach ($blogs as $article) {
                if ($article['post_status'] === "publish") {

                        /**
                         * @var $blog Blog
                         */

                        $blog = Blog::create([
                            'title' => $article['post_title'],
                            'body' => $article['post_content'],
                            'is_published' => true,
                            'meta_title' => $article['post_title'],
                            'meta_description' => $article['post_title'],
                            'featured_image' => "https://fanaka.co.ke/storage/title-deed.jpg",
                        ]);

                        $blog->setCreatedAt(Carbon::parse($article['post_date']));

                        $blog->link()->delete();

                        $blog->link()->create([
                            'type' => 'post',
                            'slug' => $article['post_name'],
                        ]);

                        event(new BlogCreatedEvent($blog));

                }

            }
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            throw  new \Exception($e->getMessage());

        }
    }
}
