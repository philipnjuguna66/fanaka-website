<?php

namespace App\Filament\AdminPanel\Resources\Concerns;

use App\Models\Permalink;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

trait SliderSectionConcern
{
    protected function sliderSection(): Block
    {
        return Block::make('slider_section')->schema([

            Repeater::make('sliders')
              ->schema([
                  FileUpload::make('image')->preserveFilenames()->required(),
                  Select::make('url')
                  ->label('link')
                  ->options(Permalink::pluck('title', 'slug'))
                  ->searchable()
                  ->preload()
                  ->lazy(),
              ])
              ->defaultItems(1),

        ]);
    }
}
