<?php

namespace App\Filament\Resources\PaymentMethods\Pages;

use App\Filament\Resources\PaymentMethods\PaymentMethodResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentMethod extends CreateRecord
{
    protected static string $resource = PaymentMethodResource::class;

    protected function getHeaderActions(): array {
        return [
            Action::make('back')
                ->label(trans('admin.back_to_list'))
                ->url(PaymentMethodResource::getUrl('index'))
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
}
