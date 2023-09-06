<?php

namespace App\Filament\Resources\Concerns;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

trait CardFormSectionConcern
{
    protected function cardSection(): Block
    {
        return Block::make('card_section')->schema([

            TextInput::make('heading')->nullable(),
            TextInput::make('subheading')->nullable(),
            TextInput::make('view_more_link')->nullable(),
            Checkbox::make('bg_white')->label('White Background')->nullable(),
            Repeater::make('cards')
            ->schema([
                TextInput::make('title')->required(),
                FileUpload::make('image')->preserveFilenames()->nullable(),
                Textarea::make('description')->required(),
                Checkbox::make('has_modal')->label('View Description on a Modal')
                ->default(false),
            ])
                ->collapsible(),

        ]);
    }
}
