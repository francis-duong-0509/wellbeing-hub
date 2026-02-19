<?php

namespace App\Filament\Resources\CourseTypes\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->label(trans('admin.course_type.name')),

                        Select::make('template_id')
                            ->options([
                                1 => 'Template 1',
                                2 => 'Template 2',
                            ])
                            ->default(1)
                            ->label(trans('admin.course_type.template_id')),

                        Select::make('back_template_id')
                            ->options([
                                1 => 'Template 1',
                                2 => 'Template 2',
                            ])
                            ->default(1)
                            ->label(trans('admin.course_type.back_template_id')),
                    ]),

                RichEditor::make('learning_outcome')
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
                    ->required()
                    ->label(trans('admin.course_type.learning_outcome')),
            ]);
    }
}
