<?php

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use App\Filament\Resources\Shield\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($record) {
                    if (in_array($record->name, ['super_admin', 'panel_user'])) {
                        throw new \Exception('Cannot delete system role: ' . $record->name);
                    }
                }),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Prevent editing system roles
        if (in_array($this->record->name, ['super_admin', 'panel_user'])) {
            $this->redirect($this->getResource()::getUrl('index'));

            \Filament\Notifications\Notification::make()
                ->warning()
                ->title('System Role')
                ->body('System roles cannot be edited.')
                ->send();
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
