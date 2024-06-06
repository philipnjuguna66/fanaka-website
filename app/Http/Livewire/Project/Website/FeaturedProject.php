<?php

namespace App\Http\Livewire\Project\Website;

use Appsorigin\Plots\Models\Project;
use Livewire\Component;

class FeaturedProject extends Component
{
    public array $projectIds = [];
    public $grid = 3;

    public function render()
    {
        return view('livewire.project.website.featured-project',[
            'projects' => Project::query()->whereIn('id', $this->projectIds)->inRandomOrder()->get()
        ]);
    }
}
