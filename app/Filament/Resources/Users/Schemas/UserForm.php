<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Country;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Lang;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('user.basic_info'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('user.name'))
                            ->placeholder(__('user.name_placeholder'))
                            ->required()
                            ->maxLength(255)
                            ->autofocus(),

                        TextInput::make('email')
                            ->label(__('user.email'))
                            ->placeholder(__('user.email_placeholder'))
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('phone_number')
                            ->label(__('user.phone_number'))
                            ->placeholder(__('user.phone_number_placeholder'))
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        Select::make('country_id')
                            ->label(__('user.country'))
                            ->placeholder(__('user.country_placeholder'))
                            ->options(Country::getActiveCountries())
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('password')
                            ->label(__('user.password'))
                            ->placeholder(__('user.password_placeholder'))
                            ->password()
                            ->revealable()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rule(Password::default())
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->dehydrateStateUsing(fn (string $state): string => bcrypt($state)),

                        TextInput::make('password_confirmation')
                            ->label(__('user.password_confirmation'))
                            ->placeholder(__('user.password_placeholder'))
                            ->password()
                            ->revealable()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->same('password')
                            ->dehydrated(false),

                        Toggle::make('is_admin')
                            ->label(__('user.is_admin'))
                            ->helperText(__('user.is_admin_help'))
                            ->inline(false)
                            ->default(false),

                        Toggle::make('is_active')
                            ->label(__('user.is_active'))
                            ->helperText(__('user.is_active_help'))
                            ->inline(false)
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make(__('user.profile'))
                    ->schema([
                        FileUpload::make('avatar')
                            ->label(__('user.avatar'))
                            ->image()
                            ->avatar()
                            ->directory('users/avatar')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->disk(config('filesystems.default')),
                    ]),

                Section::make(__('user.role'))
                    ->schema([
                        Select::make('roles')
                            ->label(__('user.role'))
                            ->multiple()
                            ->relationship('roles', 'name')
                                ->getOptionLabelFromRecordUsing(fn ($record) => Lang::has('admin.roles.' . $record->name)
                                    ? __('admin.roles.' . $record->name)
                                    : ucwords(str_replace('_', ' ', $record->name)))
                            ->preload()
                            ->searchable()
                            ->helperText(__('user.role_help'))
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('admin.permission.permission'))
                                    ->required()
                                    ->unique()
                                    ->maxLength(255),
                                TextInput::make('guard_name')
                                    ->label(__('admin.permission.guard'))
                                    ->default('web')
                                    ->required(),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
