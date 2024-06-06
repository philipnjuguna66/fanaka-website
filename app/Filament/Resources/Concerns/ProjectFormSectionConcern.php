<?php

namespace App\Filament\Resources\Concerns;

use App\Models\Permalink;
use App\Utils\Enums\ProjectStatusEnum;
use Appsorigin\Plots\Models\Project;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

trait ProjectFormSectionConcern
{
    protected function projectSection(): Block
    {
        return Block::make('project_section')->schema([
            TextInput::make('heading')->required(),
            TextInput::make('subheading')->required(),

            Checkbox::make('bg_white')->label('White Background')->nullable(),
            TextInput::make('count')->numeric(),
            Select::make('project_link')
                ->options(function (): array {

                    $options = [];

                    foreach (Permalink::query()->whereType('page')->cursor() as $link) {

                        $options[$link->slug] = $link->linkable?->name;

                    }

                    return $options;
                })
                ->searchable()
                ->preload(),
        ]);
    }

    protected function pastProjectSection(): Block
    {
        return Block::make('past_project_section')->schema([
            TextInput::make('heading')->required(),
            TextInput::make('subheading'),
            Checkbox::make('bg_white')->label('White Background')->nullable(),
            TextInput::make('count')->numeric(),
            Select::make('project_link')
                ->options(function (): array {

                    $options = [];

                    foreach (Permalink::query()->whereType('page')->cursor() as $link) {

                        $options[$link->slug] = $link->linkable?->name;

                    }

                    return $options;
                })
                ->searchable()
                ->preload(),
        ]);
    }

    protected function featuredProjects(): Block
    {
        return Block::make('featured_section')->schema([
            TextInput::make('heading')->required(),
            TextInput::make('subheading'),
            Checkbox::make('bg_white')->label('White Background')->nullable(),
            Select::make('project_ids')
                ->options(function (): array {

                    $options = [];


                    $projects =  Project::query()
                        ->with('link')
                        ->latest('created_at')
                        ->where('status',ProjectStatusEnum::FOR_SALE)
                    ->get();

                    foreach ($projects  as $link) {

                        $options[$link->id] = $link->name;

                    }

                    return $options;
                })
                ->searchable()
                ->multiple()
                ->required()
                ->preload(),


            Select::make('project_link')
                ->options(function (): array {

                    $options = [];

                    foreach (Permalink::query()->whereType('page')->cursor() as $link) {

                        $options[$link->slug] = $link->linkable?->name;

                    }

                    return $options;
                })
                ->searchable()
                ->preload(),

        ]);
    }
}
