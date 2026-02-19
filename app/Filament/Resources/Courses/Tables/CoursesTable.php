<?php

namespace App\Filament\Resources\Courses\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('name')
                    ->sortable()
                    ->label(__('course.name')),

                TextColumn::make('course_type_id')
                    ->formatStateUsing(fn($state) => $state->name)
                    ->sortable()
                    ->label(__('course.course_type_id')),

                TextColumn::make('capacity')
                    ->formatStateUsing(fn ($state) => $state == 0 ? 'Unlimited' : $state)
                    ->label(__('course.capacity')),

                TextColumn::make('fromdate')
                    ->formatStateUsing(fn($state) => $state->format('Y-m-d'))
                    ->sortable()
                    ->label(__('course.fromdate')),

                TextColumn::make('todate')
                    ->formatStateUsing(fn($state) => $state->format('Y-m-d'))
                    ->sortable()
                    ->label(__('course.todate')),

                TextColumn::make('type')
                    ->searchable(),                

                TextColumn::make('price')
                    ->label(__('course.price')),

                TextColumn::make('discount_until')
                    ->formatStateUsing(fn($state) => $state->format('Y-m-d'))
                    ->label(__('course.discount_until')),

                TextColumn::make('is_active')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive')
                    ->label(__('course.is_active')),

                TextColumn::make('country.name')
                    ->label(__('course.country')),

                TextColumn::make('createdBy.name')
                    ->label(__('course.created_by')),

                TextColumn::make('teacher.name')
                    ->label(__('course.teacher')),

                TextColumn::make('created_at')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state->format('Y-m-d'))
                    ->label(__('course.created_at')),
            ])
            ->filters([
                Filter::make('id')
                    ->form([
                        TextInput::make('id')
                            ->label('Id')
                            ->numeric(),
                    ]),

                Filter::make('name')->form([TextInput::make('name')->label(trans('course.name'))]),

                SelectFilter::make('country_id')
                    ->label(trans('course.country'))
                    ->relationship('country', 'name', modifyQueryUsing: fn (Builder $query) => $query->active())
                    ->multiple()
                    ->preload(),
                
                SelectFilter::make('type')
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ])
                    ->label(trans('course.type')),

                SelectFilter::make('course_type_id')
                    ->label(trans('course.course_type_id'))
                    ->relationship('courseType', 'name')
                    ->preload(),                

                SelectFilter::make('teacher_id')
                    ->label(trans('course.teacher'))
                    ->relationship('teacher', 'name', modifyQueryUsing: fn (Builder $query) => $query->active())
                    ->multiple()
                    ->preload(),

                Filter::make('is_active')
                        ->label(trans('course.is_active'))
                        ->toggle(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
