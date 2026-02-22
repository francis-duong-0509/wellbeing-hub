<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return __('user.edit');
    }

    protected function getHeaderActions(): array {
        return [
            Action::make('back')
                ->label(trans('admin.back_to_list'))
                ->url(UserResource::getUrl('index'))
                ->button()
                ->color('black')
                ->outlined()
                ->icon('heroicon-m-arrow-left'),
            DeleteAction::make()
                ->label(__('user.delete')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
