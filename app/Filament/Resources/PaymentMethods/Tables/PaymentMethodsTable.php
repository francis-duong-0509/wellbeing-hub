<?php

namespace App\Filament\Resources\PaymentMethods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PaymentMethodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),

                TextColumn::make('name')->label(trans('payment.payment_method.name')),

                TextColumn::make('code')->label(trans('payment.payment_method.code')),

                TextColumn::make('country.name')
                    ->label(trans('payment.payment_method.country'))
                    ->badge()
                    ->color(fn($record) => $record->country_color),

                TextColumn::make('type')
                    ->label(trans('payment.payment_method.type'))
                    ->formatStateUsing(fn ($state, $record) => $record->type_label),

                TextColumn::make('payment_type')
                    ->label(trans('payment.payment_method.payment_type'))
                    ->formatStateUsing(fn ($state, $record) => $record->payment_type_label),

                TextColumn::make('qr_url')->label(trans('payment.payment_method.qr_url')),

                ToggleColumn::make('status')->label(trans('payment.payment_method.status')),
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
