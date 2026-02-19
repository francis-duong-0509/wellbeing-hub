<?php

namespace App\Filament\Resources\Currencies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(trans('admin.currency.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(trans('admin.currency.code'))
                    ->required(),
                TextInput::make('symbol')
                    ->label(trans('admin.currency.symbol'))
                    ->required(),
            ]);
    }
}
