<?php

use App\Models\PaymentMethod;

if (!function_exists('payment_method_options')) {
    function payment_method_options(?int $countryId) {
        $methods = PaymentMethod::where(function ($query) use ($countryId) {
            return $query->where('country_id', $countryId)
                ->orWhereNull('country_id');
        })
        ->active()
        ->pluck('name', 'code')
        ->toArray();
        
        return $methods;
    }
}