<?php

namespace App\Filament\AdminPanel\Resources;

use App\Filament\AdminPanel\Resources\PageResource\Pages\EditPage;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->default(fn($livewire) => null)
                    ->password()
                    ->reactive()
                    ->rules(['required', 'string', new Password])
                    ->hidden(fn($livewire) => $livewire instanceof EditPage)
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->action(fn(array $data, User $record) => $record->update([
                        'name' => $data['name'],
                        'email' => $data['email']
                    ]))
                    ->slideOver()
                    ->closeModalByClickingAway(false)
                ->closeModalByClickingAway(false),

                Tables\Actions\Action::make('change Password')
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->form([
                    Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                        ->rules(['required', 'string', new Password])
                ])
                ->action(function (array $data , User $record) {

                    $record->update([
                        'password' => Hash::make( $data['password'])
                    ]);
                })
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\AdminPanel\Resources\UserResource\Pages\ManageUsers::route('/'),
        ];
    }
}
