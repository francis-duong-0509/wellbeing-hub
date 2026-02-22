<?php

namespace App\Filament\Resources\Courses\Pages;

use App\Filament\Resources\Courses\CourseResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
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
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->id;

        return $data;
    }
}
