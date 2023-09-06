<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhatsappResource\Pages;
use App\Filament\Resources\WhatsappResource\RelationManagers;
use App\Models\Whatsapp;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WhatsappResource extends Resource
{
    protected static ?string $model = Whatsapp::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat';

    protected static ?string $navigationGroup = "SETTINGS";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('location_id')
                    ->label('Location')
                    ->relationship('branch','name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('phone_number')->required(),
                    ])
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('avatar')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branch_id'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('avator'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListWhatsapps::route('/'),
            'create' => Pages\CreateWhatsapp::route('/create'),
            'edit' => Pages\EditWhatsapp::route('/{record}/edit'),
        ];
    }
}
