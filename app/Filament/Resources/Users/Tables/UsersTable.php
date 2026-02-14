<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('users.table.columns.id'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('users.table.columns.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('users.table.columns.email'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label(__('users.table.columns.phone_number'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('avatar')
                    ->label(__('users.table.columns.avatar'))
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_admin')
                    ->label(__('users.table.columns.is_admin'))
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label(__('users.table.columns.is_active'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_admin')
                    ->label(__('users.filters.admin_status'))
                    ->placeholder(__('users.filters.all_users'))
                    ->trueLabel(__('users.filters.admins_only'))
                    ->falseLabel(__('users.filters.non_admins_only'))
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_admin', true),
                        false: fn (Builder $query) => $query->where('is_admin', false),
                        blank: fn (Builder $query) => $query,
                    ),

                TernaryFilter::make('is_active')
                    ->label(__('users.filters.active_status'))
                    ->placeholder(__('users.filters.all_users'))
                    ->trueLabel(__('users.filters.active_only'))
                    ->falseLabel(__('users.filters.inactive_only'))
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_active', true),
                        false: fn (Builder $query) => $query->where('is_active', false),
                        blank: fn (Builder $query) => $query,
                    ),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
