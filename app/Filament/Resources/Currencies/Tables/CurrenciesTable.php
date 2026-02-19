<?php

namespace App\Filament\Resources\Currencies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurrenciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.currency.name')),
                TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.currency.code')),
                TextColumn::make('symbol')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.currency.symbol')),
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
