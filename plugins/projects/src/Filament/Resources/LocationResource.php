<?php

namespace Appsorigin\Plots\Filament\Resources;


use Appsorigin\Plots\Filament\Resources\LocationResource\Pages\CreateLocation;
use Appsorigin\Plots\Filament\Resources\LocationResource\Pages\EditLocation;
use Appsorigin\Plots\Filament\Resources\LocationResource\Pages\ListLocations;
use Appsorigin\Plots\Models\Location;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;


    protected static ?string $label  = "Location";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->reactive()
                    ->afterStateUpdated(fn($set, $state) => $set('slug', str($state)->slug()))
                    ->required(),
                TextInput::make('slug')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('slug')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
               // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListLocations::route('/'),
            'create' => CreateLocation::route('/create'),
            'edit' => EditLocation::route('/{record}/edit'),
        ];
    }
}
