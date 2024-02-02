<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Page;
use App\Models\User;
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
    }
}
