<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Role;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Closure;
use Filament\Forms\Components\Checkbox;
use Illuminate\Database\Eloquent\Builder;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location')
                    ->columns(3)
                    ->components([
                        Select::make('country_id')
                            ->label(trans('course.country'))
                            ->relationship('country', 'name', modifyQueryUsing: fn ($query) => $query->active())
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('state_id', null);
                                $set('currency_id', Currency::getDefaultCurrency($state));
                                $teacher = User::getTeacherByCountryId($state)->first();
                                $set('teacher_id', $teacher ? $teacher->id : null);
                            })
                            ->required(),

                        Select::make('state_id')
                            ->label(trans('course.state'))
                            ->relationship('state', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                                $countryId = $get('country_id');

                                if (!$countryId) {
                                    return $query->whereNull('id');
                                }

                                return $query->getCountry($countryId);
                            })
                            ->required(),

                        Select::make('language_code')
                            ->label(trans('course.default_language'))
                            ->options(function (Get $get) {
                                $countryId = $get('country_id');

                                if (!$countryId) return [];

                                return Country::getDefaultLanguages($countryId);
                            })
                            ->required(),
                    ])
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label(trans('course.name'))
                    ->required()
                    ->columnSpanFull(),
                
                Select::make('type')
                    ->label(trans('course.type'))
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ])
                    ->default('offline')
                    ->required(),
                
                Select::make('course_type_id')
                    ->label(trans('course.course_type_id'))
                    ->relationship('courseType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                RichEditor::make('description')
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'italic',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->label(trans('course.description'))
                    ->required()
                    ->columnSpanFull(),

                DatePicker::make('fromdate')->label(trans('course.fromdate')),

                DatePicker::make('todate')->label(trans('course.todate')),

                FileUpload::make('thumbnail')
                    ->label(trans('course.thumbnail'))
                    ->directory('courses/thumbnails')
                    ->visibility('public')
                    ->imagePreviewHeight('200')
                    ->columnSpanFull(),

                Section::make(trans('course.pricing'))
                        ->columns(6)
                        ->components([
                            TextInput::make('price')
                                ->label(trans('course.price'))
                                ->numeric()
                                ->default(0)
                                ->live(),

                            Select::make('discount_type')
                                ->label(trans('course.discount_type'))
                                ->options([
                                    'percentage' => trans('course.percentage'),
                                    'fixed' => trans('course.fixed'),
                                ])
                                ->live()
                                ->afterStateUpdated(function (Set $set) {
                                    $set('discount_price', 0);
                                }),

                            TextInput::make('discount_price')
                                ->label(trans('course.discount_price'))
                                ->numeric()
                                ->default(0)
                                ->live()
                                ->rule(function (Get $get) {
                                    return function (string $attribute, $value, Closure $fail) use ($get) {
                                        $type = $get('discount_type');
                                        $price = $get('price');

                                        if ($type === 'percentage' && $value > 100) {
                                            $fail(trans('course.discount_percentage_cannot_exceed_100.'));
                                        }

                                        if ($type === 'fixed' && $value > 0 && $value >= $price) {
                                            $fail(trans('course.discount_price_must_be_less_than_the_original_price.'));
                                        }
                                    };
                                }),

                            DatePicker::make('discount_until')->label(trans('course.discount_until')),

                            Select::make('currency_id')
                                ->label(trans('course.currency'))
                                ->options(function (Get $get) {
                                    $countryId = $get('country_id');

                                    if (!$countryId) return [];

                                    return Currency::where('country_id', $countryId)->pluck('name', 'id');
                                })
                                ->default(Currency::getDefaultCurrency(request()->user()->country_id))
                                ->required(),

                            Checkbox::make('enable_member_discount')
                                ->label(trans('course.enable_member_discount'))
                                ->inline(false)
                                ->default(false),
                        ])
                        ->columnSpanFull(),

                TextInput::make('capacity')
                    ->label(trans('course.capacity'))
                    ->numeric()
                    ->default(0),

                Select::make('teacher_id')
                    ->label(trans('course.teacher'))
                    ->relationship('teacher', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                        $countryId = $get('country_id');
                        if (!$countryId) {
                            return $query->whereNull('id');
                        }
                        return $query->where('country_id', $countryId)->whereHas('roles', function ($q) {
                            $q->where('slug', Role::ROLE_SLUG_TEACHER);
                        });
                    })
                    ->searchable()
                    ->preload(),

                /* Select::make('available_payment_method')
                    ->label(trans('course.available_payment_method'))
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ])
                    ->default('offline')
                    ->required(), */
            ]);
    }
}