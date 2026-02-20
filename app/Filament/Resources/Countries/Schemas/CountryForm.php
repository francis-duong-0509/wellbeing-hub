<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\Select;
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
                    ->label(trans('admin.country.name'))
                    ->readOnly(),

                TextInput::make('iso2')
                    ->label(trans('admin.country.iso2'))
                    ->readOnly(),

                TextInput::make('phone_code')
                    ->label(trans('admin.country.phone_code'))
                    ->readOnly(),

                TextInput::make('region')
                    ->label(trans('admin.country.region'))
                    ->readOnly(),

                TextInput::make('subregion')
                    ->label(trans('admin.country.subregion'))
                    ->readOnly(),

                Select::make('languages')
                    ->label(trans('admin.country.languages'))
                    ->relationship('languages', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),

                Toggle::make('is_active')
                    ->label(trans('admin.country.is_active')),
            ]);
    }
}
