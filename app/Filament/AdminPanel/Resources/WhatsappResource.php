<?php

namespace App\Filament\AdminPanel\Resources;

use App\Filament\Resources\WhatsappResource\Pages;
use App\Filament\Resources\WhatsappResource\RelationManagers;
use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WhatsappResource extends Resource
{
    protected static ?string $model = Whatsapp::class;


    protected static ?string $navigationGroup = "SETTINGS";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('location_tags')
                    ->label('Location Tags')
                    ->options(Location::query()->pluck('name', 'id'))
                    ->getSearchResultsUsing(fn(string $search) => Location::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id'))
                    ->multiple()
                    ->createOptionForm([
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->reactive()
                                    ->afterStateUpdated(fn($set, $state) => $set('slug', str($state)->slug()))
                                    // ->disabled(fn(Page $livewire) : bool => $livewire instanceof  Pages\EditProject)
                                    ->required(),
                                TextInput::make('slug')->required()->unique('locations', 'slug'),
                            ]),
                    ])
                    ->createOptionModalHeading("Create a Location")
                    ->createOptionUsing(function (array $data, \Closure $set) {
                        if (Location::query()->where([
                            'name' => $data['name'],
                            'slug' => $data['slug'],
                        ])->exists())
                        {
                            return Notification::make()
                                ->title("Something went wrong")
                                ->body("Location Tag already exists")
                                ->send();
                        }
                        Location::create([
                            'name' => $data['name'],
                            'slug' => $data['slug'],
                        ]);

                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->placeholder("254799001133")
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('location_name')
                ->default(fn(Whatsapp $record) => Location::query()
                    ->whereIn('id', $record->location_tags)->get()->implode('name',', ')),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\AdminPanel\Resources\WhatsappResource\Pages\ListWhatsapps::route('/'),
            'create' => \App\Filament\AdminPanel\Resources\WhatsappResource\Pages\CreateWhatsapp::route('/create'),
            'edit' => \App\Filament\AdminPanel\Resources\WhatsappResource\Pages\EditWhatsapp::route('/{record}/edit'),
        ];
    }
}
