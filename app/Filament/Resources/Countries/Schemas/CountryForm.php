<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(trans('admin.country.name'))
                    ->required(),
                TextInput::make('iso2')
                    ->label(trans('admin.country.iso2'))
                    ->required(),
                TextInput::make('phone_code')
                    ->label(trans('admin.country.phone_code'))
                    ->required(),
                TextInput::make('region')
                    ->label(trans('admin.country.region'))
                    ->required(),
                TextInput::make('subregion')
                    ->label(trans('admin.country.subregion'))
                    ->required(),
            ]);
    }
}
