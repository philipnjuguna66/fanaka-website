<?php

namespace App\Filament\Resources\Concerns;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

trait HeroImageSectionConcern
{
    protected function heroLeftImage(): Block
    {
        return Block::make('hero_left_image_section')->label('Hero section With Image')->schema([

            TextInput::make('heading')->nullable(),
            Checkbox::make('margin_top')->label('Add margin Top'),
            Select::make('align_image')->options([
                'left' => 'Left',
                'right' => 'Right',
            ])
                ->preload()
                ->searchable()
                ->required(),
            RichEditor::make('description')->required(),
            FileUpload::make('image')->preserveFilenames()->required(),
            Checkbox::make('bg_white')->label('White Background')->required(),
            Grid::make(2)->schema([
                TextInput::make('cta_url')->label('cta url'),
                TextInput::make('cta_name')->label('cta label'),
            ]),

        ]);
    }
    public function heroWithService(): Block
    {
        return Block::make('hero_with_service_section')->reactive()->label(function(\Closure $get ) : string {
            return  $get('heading') ?? "Hero with Sections";
        })
            ->schema([
                TextInput::make('heading')->reactive(),
                Textarea::make('subheading')->reactive(),
                FileUpload::make('image')->preserveFilenames()->required(),
                Repeater::make('sections')
                    ->schema([
                        RichEditor::make('content')
                    ]),
                Checkbox::make('has_contact_form'),
            ]);
    }
    public function htmlSection(): Block
    {
        return Block::make('html_section')
            ->schema([
               Textarea::make('html')
                ->helperText('paste html code here, use tailwind css')
            ]);
    }
}
