<?php

namespace App\Http\Livewire\Teams;

use App\Utils\Enums\TeamTypeEnum;
use Appsorigin\Plots\Models\Blog;
use Appsorigin\Teams\Models\CompanyTeam;
use Appsorigin\Teams\Models\TeamCategory;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use  WithPagination;

    const CACHE_KEY = 'post';

    public $take = 0;


    public function mount(?int $take): void
    {

        $this->take = $take;


    }


    public function render()
    {



        $teams = CompanyTeam::query()
            ->with('link')
            ->whereNot('type', TeamTypeEnum::CEO)
            ->oldest('created_at');

        if ($this->take > 0) {

            $teams = $teams
                ->limit($this->take);
        }


        $ceo = CompanyTeam::query()
            ->with('link')
            ->where('type', TeamTypeEnum::CEO)
            ->oldest('created_at')
        ->first();


        return view('livewire.teams.all')->with([
            'teams' => $teams->simplePaginate($this->take ?? 6),
            'ceo' => $ceo,
        ]);
    }
}
