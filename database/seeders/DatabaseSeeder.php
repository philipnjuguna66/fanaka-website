<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Events\BlogCreatedEvent;
use App\Models\Page;
use App\Models\User;
use Appsorigin\Blog\Models\Blog;
use Appsorigin\Plots\Models\Project;
use Appsorigin\Plots\Models\ProjectLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Philip Njuguna',
            'email' => 'info@fanaka.co.ke',
            'password' => Hash::make('philip.njuguna'),
        ]);

        /** @var Page $page */
        $page = Page::create([
            'title' =>"Home PAGE",
            'meta_title' => "Affordable plots for sale",
            'meta_description' => "Affordable land",
            'is_published' => true,
            'is_front_page' => true,
            'published_at' => now(),
        ]);

        $page->link()->create([
            'slug' => str($page->title)->slug('-')->value(),
            'type' => 'page',
        ]);



        // project


        $slug = fake()->slug(4);
        $projectData = [
            'use_page_builder' => false,
            'name' =>  fake()->name,
            'status' =>  \App\Utils\Enums\ProjectStatusEnum::FOR_SALE->value,
            'price' => "1.9M",
            'meta_title' =>  fake()->title,
            'meta_description' => fake()->name,
            'featured_image' =>  fake()->imageUrl,
            'amenities' =>  fake()->paragraphs(2, true),
            'body' =>  fake()->paragraphs(7, true),
        ];



        $project = Project::create($projectData);

        $project->link()->create([
            'slug' => $slug,
            'type' => 'project',
        ]);


        event(new BlogCreatedEvent($project));


        $blog = Blog::create([
            'title' => fake()->title,
            'body' =>  fake()->paragraphs(19, true),
            'is_published' => true,
            'canonical' => null,
            'meta_title' =>  fake()->title,
            'meta_description' =>  fake()->title,
            'featured_image' =>  fake()->title,
        ]);

        $blog->link()->create([
            'type' => 'post',
            'slug' => fake()->slug,
        ]);
    }
}
