<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('users.form.sections.basic_info'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('users.form.fields.name'))
                            ->placeholder(__('users.form.placeholders.name'))
                            ->required()
                            ->maxLength(255)
                            ->autofocus(),

                        TextInput::make('email')
                            ->label(__('users.form.fields.email'))
                            ->placeholder(__('users.form.placeholders.email'))
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('phone_number')
                            ->label(__('users.form.fields.phone_number'))
                            ->placeholder(trans('users.form.placeholders.phone_number'))
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        TextInput::make('password')
                            ->label(__('users.form.fields.password'))
                            ->placeholder(__('users.form.placeholders.password'))
                            ->password()
                            ->revealable()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rule(Password::default())
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->dehydrateStateUsing(fn (string $state): string => bcrypt($state)),

                        TextInput::make('password_confirmation')
                            ->label(__('users.form.fields.password_confirmation'))
                            ->placeholder(__('users.form.placeholders.password'))
                            ->password()
                            ->revealable()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->same('password')
                            ->dehydrated(false),

                        Toggle::make('is_admin')
                            ->label(__('users.form.fields.is_admin'))
                            ->helperText(__('users.form.help_text.is_admin'))
                            ->inline(false)
                            ->default(false),

                        Toggle::make('is_active')
                            ->label(__('users.form.fields.is_active'))
                            ->helperText(__('users.form.help_text.is_active'))
                            ->inline(false)
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make(__('users.form.sections.profile'))
                    ->schema([
                        FileUpload::make('avatar')
                            ->label(__('users.form.fields.avatar'))
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->directory('avatars')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                    ]),
            ]);
    }
}
