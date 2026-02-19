<?php

namespace App\Filament\Resources\CourseTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseTypesTable
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
                    ->label(__('admin.course_type.name')),
                TextColumn::make('template_id')
                    ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'Template 1' : 'Template 2';
                    })
                    ->sortable()
                    ->label(__('admin.course_type.template_id')),
                TextColumn::make('back_template_id')
                    ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'Template 1' : 'Template 2';
                    })
                    ->sortable()
                    ->label(__('admin.course_type.back_template_id')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
