<?php

namespace App\Filament\Resources\Languages\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LanguagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),

                TextColumn::make('name'),

                TextColumn::make('name_native'),

                TextColumn::make('dir'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                /* EditAction::make(), */
            ]);
    }
}
