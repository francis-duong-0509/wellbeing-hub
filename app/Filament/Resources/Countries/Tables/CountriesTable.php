<?php

namespace App\Filament\Resources\Countries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CountriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('iso2')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.country.iso2')),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.country.name')),
                TextColumn::make('phone_code')
                    ->numeric()
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.country.phone_code')),
                TextColumn::make('region')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.country.region')),
                TextColumn::make('subregion')
                    ->searchable()
                    ->sortable()
                    ->label(trans('admin.country.subregion')),
                ToggleColumn::make('is_active')
                    ->searchable()
                    ->label(trans('admin.country.is_active')),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label(trans('admin.country.is_active'))
                    ->options([
                        true => trans('admin.country.is_active'),
                        false => trans('admin.country.is_inactive'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
