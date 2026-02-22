<?php

namespace App\Filament\Resources\Courses\Tables;

use Carbon\Carbon;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
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

                ImageColumn::make('thumbnail')
                            ->disk('s3')
                            ->columnSpanFull(),

                TextColumn::make('name')
                    ->sortable()
                    ->label(__('course.name')),

                TextColumn::make('courseType.name')
                    ->label(__('course.course_type')),

                TextColumn::make('capacity')
                    ->formatStateUsing(fn ($state) => $state == 0 ? trans('course.unlimited') : $state)
                    ->label(__('course.capacity'))
                    ->badge(fn ($state) => $state !== 0)
                    ->color(fn ($state) => $state === 0 ? 'gray' : 'primary'),

                TextColumn::make('fromdate')
                    ->date('Y-m-d')
                    ->sortable()
                    ->label(__('course.fromdate'))
                    ->badge()
                    ->color('warning'),

                TextColumn::make('todate')
                    ->date('Y-m-d')
                    ->sortable()
                    ->label(__('course.todate'))
                    ->badge()
                    ->color('warning'),

                TextColumn::make('type')
                    ->searchable()
                    ->label(__('course.type'))
                    ->badge()
                    ->color(fn($state) => $state == 'online' ? 'success' : 'danger'),

                TextColumn::make('price')
                    ->label(__('course.price'))
                    ->currencyFormat(),

                TextColumn::make('discount_until')
                    ->label(__('course.discount_until'))
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('Y-m-d'))
                    ->placeholder(trans('course.no_discount'))
                    ->badge()
                    ->color(fn ($state) => $state === null ? 'gray' : 'warning'),

                TextColumn::make('is_active')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive')
                    ->label(__('course.is_active')),

                TextColumn::make('country.name')
                    ->label(__('course.country'))
                    ->badge()
                    ->color('primary'),

                TextColumn::make('createdBy.name')
                    ->label(__('course.created_by'))
                    ->badge()
                    ->color('secondary'),

                TextColumn::make('teacher.name')
                    ->label(__('course.teacher'))
                    ->badge()
                    ->color('secondary'),

                TextColumn::make('created_at')
                    ->sortable()
                    ->date('Y-m-d')
                    ->label(__('course.created_at'))
                    ->badge()
                    ->color('warning'),
            ])
            ->filters([
                Filter::make('id')
                    ->form([
                        TextInput::make('id')
                            ->label('Id')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['id'],
                            fn (Builder $query, $id): Builder => $query->where('id', $id),
                        );
                    }),

                Filter::make('name')
                    ->form([TextInput::make('name')->label(trans('course.name'))])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['name'],
                            fn (Builder $query, $name): Builder => $query->where('name', 'LIKE', '%' . $name . '%'),
                        );
                    }),

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
                    ->label(trans('course.course_type'))
                    ->relationship('courseType', 'name')
                    ->preload(),
                    

                Filter::make('fromdate')
                    ->form([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('from')
                                    ->label(trans('course.fromdate')),
                                DatePicker::make('until')
                                    ->label(trans('course.fromdate')),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fromdate', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fromdate', '<=', $date),
                            );
                    }),

                SelectFilter::make('teacher_id')
                    ->label(trans('course.teacher'))
                    ->relationship('teacher', 'name', modifyQueryUsing: fn (Builder $query) => $query->active())
                    ->multiple()
                    ->preload(),

                Filter::make('is_active')
                        ->label(trans('course.is_active'))
                        ->toggle(),
            ])
            ->filtersFormColumns(2)
            ->filtersFormWidth('4xl')
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
                DeleteBulkAction::make(),
            ]);
    }
}
