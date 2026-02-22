<?php

namespace App\Filament\Resources\Courses\Pages;

use App\Filament\Resources\Courses\CourseResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array {
        return [
            Action::make('back')
                ->label(trans('admin.back_to_list'))
                ->url(CourseResource::getUrl('index'))
                ->button()
                ->color('black')
                ->outlined()
                ->icon('heroicon-m-arrow-left'),
            
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
