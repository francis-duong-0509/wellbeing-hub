<?php

namespace App\Filament\Resources\Shield;

use App\Filament\Resources\Shield\RoleResource\Pages;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use UnitEnum;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-shield-check';

    protected static string | UnitEnum | null $navigationGroup = 'Shield';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Role Name'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('e.g., editor, moderator'),

                        TextInput::make('guard_name')
                            ->label(__('Guard'))
                            ->default('web')
                            ->required()
                            ->maxLength(255),

                        Section::make(__('Permissions'))
                            ->schema([
                                CheckboxList::make('permissions')
                                    ->relationship('permissions', 'name')
                                    ->label('')
                                    ->columns(2)
                                    ->gridDirection('row')
                                    ->searchable()
                                    ->bulkToggleable(),
                            ])
                            ->collapsible(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Role Name'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'super_admin' => 'Administrator',
                        'panel_user' => 'General Member',
                        default => ucwords(str_replace('_', ' ', $state)),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'panel_user' => 'success',
                        default => 'primary',
                    }),

                /*Tables\Columns\TextColumn::make('guard_name')
                    ->label(__('Guard'))
                    ->badge()
                    ->color('gray')
                    ->searchable(),*/

                Tables\Columns\TextColumn::make('permissions_count')
                    ->label(__('Permissions'))
                    ->counts('permissions')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('users_count')
                    ->label(__('Users'))
                    ->counts('users')
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('guard_name')
                    ->label(__('Guard'))
                    ->options([
                        'web' => 'Web',
                        'api' => 'API',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->disabled(fn (Role $record): bool => in_array($record->name, ['super_admin', 'panel_user']))
                    ->tooltip(fn (Role $record): ?string => in_array($record->name, ['super_admin', 'panel_user'])
                        ? 'System role cannot be edited'
                        : null),
                DeleteAction::make()
                    ->before(function (Role $record) {
                        // Prevent deletion of system roles
                        if (in_array($record->name, ['super_admin', 'panel_user'])) {
                            throw new \Exception('Cannot delete system role: ' . $record->name);
                        }
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
