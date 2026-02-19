<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(trans('admin.country.name')),
                TextInput::make('iso2')
                    ->label(trans('admin.country.iso2')),
                TextInput::make('phone_code')
                    ->label(trans('admin.country.phone_code')),
                TextInput::make('region')
                    ->label(trans('admin.country.region')),
                TextInput::make('subregion')
                    ->label(trans('admin.country.subregion')),
                Toggle::make('is_active')
                    ->label(trans('admin.country.is_active')),
            ]);
    }
}
