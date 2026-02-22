<?php

namespace App\Filament\Resources\Shield;

use App\Filament\Resources\Shield\PermissionResource\Pages;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Lang;
use UnitEnum;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-key';

    protected static string | UnitEnum | null $navigationGroup = 'Admin';

    protected static ?int $navigationSort = 3;

    public static function getLabel(): ?string
    {
        return __('admin.menu_name.permission');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin.menu_name.permission');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('admin.permission.permission'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder(__('admin.permission.permission_placeholder'))
                            ->helperText(__('admin.permission.permission_helper_text')),

                        TextInput::make('guard_name')
                            ->label(__('admin.permission.guard'))
                            ->default('web')
                            ->hidden()
                            ->maxLength(255),

                        Section::make(__('admin.permission.assigned_to_roles'))
                            ->schema([
                                CheckboxList::make('roles')
                                    ->label(__('admin.permission.assigned_roles'))
                                    ->relationship('roles', 'name')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => Lang::has('admin.roles.' . $record->name)
                                        ? __('admin.roles.' . $record->name)
                                        : ucwords(str_replace('_', ' ', $record->name)))
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
                    ->label(__('admin.permission.permission'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('admin.permission.assigned_roles'))
                    ->formatStateUsing(fn (string $state): string => Lang::has('admin.roles.' . $state)
                        ? trans('admin.roles.' . $state)
                        : ucwords(str_replace('_', ' ', $state)))
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->separator(','),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.permission.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.permission.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                /* Tables\Filters\SelectFilter::make('guard_name')
                    ->label(__('admin.permission.guard'))
                    ->options([
                        'web' => 'Web',
                        'api' => 'API',
                    ]), */

                Tables\Filters\SelectFilter::make('roles')
                    ->label(__('admin.permission.assigned_roles'))
                    ->relationship('roles', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => Lang::has('admin.roles.' . $record->name)
                        ? __('admin.roles.' . $record->name)
                        : ucwords(str_replace('_', ' ', $record->name)))
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name', 'asc');
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'view' => Pages\ViewPermission::route('/{record}'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
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
