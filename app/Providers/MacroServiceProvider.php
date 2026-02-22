<?php

namespace App\Providers;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        TextColumn::macro('currencyFormat', function () {
            return $this->formatStateUsing(function ($state, $record) {
                if ($state === null) return null;

                if ($record->discount_type === 'percentage' && $record->discount_price !== null) {
                    $state = $state - $state * $record->discount_price / 100;
                }

                if ($record->discount_type === 'fixed' && $record->discount_price !== null) {
                    $state = $state - $record->discount_price;
                }

                $formattedState = number_format($state, 2);

                if (str_ends_with($formattedState, '.00')) {
                    $formattedState = substr($formattedState, 0, -3);
                }

                return $record->currency->symbol . $formattedState;
            });
        });
    }
}
