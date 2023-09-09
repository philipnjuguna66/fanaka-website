<?php

namespace App\Imports;


use App\Events\BlogCreatedEvent;
use Appsorigin\Blog\Models\Blog;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;


class PropertiesImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function chunkSize(): int
    {
        return 100;
    }

    public function collection(Collection $rows)
    {

        try {
            DB::beginTransaction();

            $rows->each(function ($article) {
                if ($article['post_status'] === "publish" && !Blog::query()->where(['title' => $article['post_title']])->exists()) {

                    /**
                     * @var $blog Blog
                     */

                    $blog = Blog::create([
                        'title' => $article['post_title'],
                        'body' => $article['post_content'],
                        'is_published' => true,
                        'meta_title' => str($article['post_title'])->append(time())->append(time())->toString(),
                        'meta_description' => str($article['post_title'])->append(time())->toString(),
                        'featured_image' => "https://fanaka.co.ke/storage/title-deed.jpg",
                    ]);

                    $blog->setCreatedAt(Carbon::parse($article['post_date']));
                    $blog->save();

                    $blog->link()->delete();

                    $blog->link()->create([
                        'type' => 'post',
                        'slug' => $article['post_name'],
                    ]);

                    event(new BlogCreatedEvent($blog));

                }
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();


            throw  new \Exception($e->getMessage());

        }
    }
}
