<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('user.id'))
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('avatar')
                    ->label(__('user.avatar'))
                    ->width(50)
                    ->circular()
                    ->defaultImageUrl(fn ($record) => storage_s3_url($record->avatar, asset('images/default-avatar.png'))),

                TextColumn::make('name')
                    ->label(__('user.name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label(__('user.email'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone_number')
                    ->label(__('user.phone_number'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('country.name')
                    ->label(__('user.country'))
                    ->searchable(),

                IconColumn::make('is_admin')
                    ->label(__('user.is_admin'))
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('user.is_active'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_admin')
                    ->label(__('user.admin_status'))
                    ->placeholder(__('user.all_users'))
                    ->trueLabel(__('user.admins_only'))
                    ->falseLabel(__('user.non_admins_only'))
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_admin', true),
                        false: fn (Builder $query) => $query->where('is_admin', false),
                        blank: fn (Builder $query) => $query,
                    ),

                TernaryFilter::make('is_active')
                    ->label(__('user.active_status'))
                    ->placeholder(__('user.all_users'))
                    ->trueLabel(__('user.active_only'))
                    ->falseLabel(__('user.inactive_only'))
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_active', true),
                        false: fn (Builder $query) => $query->where('is_active', false),
                        blank: fn (Builder $query) => $query,
                    ),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->visible(function ($record) {
                        $currentUser = Auth::user();

                        if (! $currentUser->is_admin) {
                            return false;
                        }

                        if ($record->id === $currentUser->id) {
                            return false;
                        }

                        if ($record->is_admin) {
                            return false;
                        }

                        return true;
                    })
                    ->before(function ($record) {
                        if ($record->is_admin) {
                            throw new \Exception('Cannot delete admin users');
                        }

                        if ($record->id === Auth::id()) {
                            throw new \Exception('Cannot delete your own account');
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
