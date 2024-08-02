<?php

namespace App\Utils\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\AnonymousComponent;
use Livewire\Livewire;
use Livewire\LivewireManager;

class ShortcodeService
{

    public function replaceShortcodes($content)
    {

        $pattern = '/\["project:(\d+),\s*take:(\d+)"\]/';


        if (preg_match($pattern, $content, $matches)) {

            $project = $matches[1];
            $take = $matches[2];

            return $this->renderLivewireComponent('project.website.list-project', [
                'projectId' => $project,
                'take' => $take,
            ]);
        }



        return $content;

    }

    protected function renderLivewireComponent($component, $params)
    {


       return Blade::render('<livewire:'.$component.' :take="1", :project-id="1">');
    }

}
