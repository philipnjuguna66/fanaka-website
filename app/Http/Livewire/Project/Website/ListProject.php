<?php

namespace App\Http\Livewire\Project\Website;

use App\Utils\Enums\ProjectStatusEnum;
use Appsorigin\Plots\Models\Project;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ListProject extends Component
{
    use WithPagination;

    public $take = 0;

    public $grid = 3;

    public  $projectId = null;

    public function mount(?int $take)
    {
        $this->take = $take;

    }

    public function render()
    {

        $projects = Project::query()
            ->when(filled($this->projectId), fn(Builder $query, $projectId) => $query->where('id', $projectId))
            ->with('link')
            ->latest('id')
            ->inRandomOrder()
            ->where('status',ProjectStatusEnum::FOR_SALE);

        if ($this->take > 0) {

            $projects = $projects
                ->limit($this->take);
        }

        return view('livewire.project.website.list-project')->with([
            'projects' => $projects->paginate($this->take ?? 9)
        ]);
    }
}
