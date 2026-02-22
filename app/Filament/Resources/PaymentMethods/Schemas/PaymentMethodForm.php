<?php

namespace App\Filament\Resources\PaymentMethods\Schemas;

use App\Models\PaymentMethod;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(trans('payment.payment_method.name'))
                    ->required(),

                TextInput::make('code')
                    ->label(trans('payment.payment_method.code'))
                    ->required(),

                Select::make('country_id')
                    ->label(trans('payment.payment_method.country'))
                    ->relationship('country', 'name', modifyQueryUsing: fn ($query) => $query->active())
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if (empty($state)) {
                            $set('type', PaymentMethod::TYPE_INTERNATIONAL);
                            $set('payment_type', PaymentMethod::PAYMENT_TYPE_CASH);
                        } else {
                            $existingPaymentMethod = PaymentMethod::where('country_id', $state)->first();

                            if ($existingPaymentMethod) {
                                $set('type', $existingPaymentMethod->type);
                                $set('payment_type', $existingPaymentMethod->payment_type);
                            } else {
                                $set('type', PaymentMethod::TYPE_DOMESTIC);
                                $set('payment_type', PaymentMethod::PAYMENT_TYPE_BANKING);
                            }
                        }
                    })
                    ->default(null),

                Select::make('type')
                    ->label(trans('payment.payment_method.type'))
                    ->options([
                        PaymentMethod::TYPE_DOMESTIC => trans('payment.payment_method.domestic'),
                        PaymentMethod::TYPE_INTERNATIONAL => trans('payment.payment_method.international'),
                    ])
                    ->default(PaymentMethod::TYPE_INTERNATIONAL)
                    ->required(),

                Select::make('payment_type')
                    ->label(trans('payment.payment_method.payment_type'))
                    ->options([
                        PaymentMethod::PAYMENT_TYPE_CASH => trans('payment.payment_method.cash'),
                        PaymentMethod::PAYMENT_TYPE_BANKING => trans('payment.payment_method.banking'),
                        PaymentMethod::PAYMENT_TYPE_MERCHANT => trans('payment.payment_method.merchant'),
                    ])
                    ->default(PaymentMethod::PAYMENT_TYPE_CASH)
                    ->required(),

                FileUpload::make('qr_url')
                    ->label(trans('payment.payment_method.qr_url')),

                RichEditor::make('bank_account_info')
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
                    ->label(trans('payment.payment_method.bank_account_info'))
                    ->columnSpanFull(),
            ]);
    }
}
