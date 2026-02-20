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
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use UnitEnum;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-shield-check';

    protected static string | UnitEnum | null $navigationGroup = 'Admin';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(trans('admin.role.name'))
                            ->required()
                            ->unique(ignoreRecord: true)                            
                            ->maxLength(255)
                            ->placeholder('e.g., editor')
                            ->live()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label(trans('admin.role.slug'))
                            ->required()
                            ->readOnly()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('e.g., editor'),

                        TextInput::make('guard_name')
                            ->label(trans('admin.role.guard_name'))
                            ->default('web')
                            ->required()
                            ->maxLength(255)
                            ->readOnly(),

                        Section::make(trans('admin.role.permission'))
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
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(trans('admin.role.name'))
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

                /*TextColumn::make('guard_name')
                    ->label(__('Guard'))
                    ->badge()
                    ->color('gray')
                    ->searchable(),*/

                TextColumn::make('slug')
                    ->label(trans('admin.role.slug'))
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('permissions_count')
                    ->label(trans('admin.role.permissions_count'))
                    ->counts('permissions')
                    ->badge()
                    ->color('info'),

                TextColumn::make('users_count')
                    ->label(trans('admin.role.users_count'))
                    ->counts('users')
                    ->badge()
                    ->color('warning'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('guard_name')
                    ->label(trans('admin.role.guard_name'))
                    ->options([
                        'web' => 'Web',
                        'api' => 'API',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
