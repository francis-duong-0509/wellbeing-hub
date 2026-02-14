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
use UnitEnum;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-key';

    protected static string | UnitEnum | null $navigationGroup = 'Shield';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Permission Name'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('e.g., view:User, create:Post')
                            ->helperText('Use format: action:Resource (e.g., view:User, create:Post)'),

                        TextInput::make('guard_name')
                            ->label(__('Guard'))
                            ->default('web')
                            ->required()
                            ->maxLength(255),

                        Section::make(__('Assigned to Roles'))
                            ->schema([
                                CheckboxList::make('roles')
                                    ->relationship('roles', 'name')
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
                    ->label(__('Permission'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('guard_name')
                    ->label(__('Guard'))
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('Assigned Roles'))
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->separator(','),

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

                Tables\Filters\SelectFilter::make('roles')
                    ->label(__('Role'))
                    ->relationship('roles', 'name')
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
