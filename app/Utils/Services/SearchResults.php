<?php

namespace App\Utils\Services;

use Appsorigin\Blog\Models\Blog;
use Appsorigin\Plots\Models\Project;
use Illuminate\Support\Facades\Storage;

class SearchResults
{

    public static function make(): static
    {
        return new static();
    }

    public function search(string $searchTerm): array
    {

        return array_merge($this->searchProjects($searchTerm), $this->searchBlog($searchTerm));
    }


    private function searchProjects($searchTerm): array
    {
        $results = [];

        $projects = Project::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('body', 'LIKE', "%{$searchTerm}%")
            ->orWhere('meta_title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('meta_description', 'LIKE', "%{$searchTerm}%")
            ->with('link')
            ->get();


        foreach ($projects as $project) {

            $results[] = [
                'title' => str($project->name)->trim()->toString(),
                'url' => route('permalink.property.show', $project->link),
                'featured_image' => Storage::url($project->featured_image),
            ];

        }
        return $results;



    }
    private function searchBlog($searchTerm): array
    {
        $results = [];

        $blogs = Blog::query()
            ->orWhere('body', 'LIKE', "%{$searchTerm}%")
            ->orWhere('meta_title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('meta_description', 'LIKE', "%{$searchTerm}%")
            ->with('link')
            ->get();


        foreach ($blogs as $blog) {

            $results[] = [
                'title' => str($blog->title)->trim()->toString(),
                'url' => route('permalink.show', $blog->link),
                'featured_image' => Storage::url($blog->featured_image),
            ];

        }
        return $results;



    }
}
