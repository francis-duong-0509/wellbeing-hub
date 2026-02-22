<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'country_id', 'type', 'status', 'payment_type', 'bank_account_info', 'qr_url',
    ];

    const TYPE_DOMESTIC = 1;
    const TYPE_INTERNATIONAL = 2;
    const PAYMENT_TYPE_CASH = 1;
    const PAYMENT_TYPE_BANKING = 2;
    const PAYMENT_TYPE_MERCHANT = 3;

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function country(): BelongsTo {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /*=============================================== SCOPES ===============================================*/
    public function scopeActive($query) {
        return $query->where('status', 1);
    }

    /*=============================================== ATTRIBUTES ===============================================*/
    public function getCountryColorAttribute() {
        return match ($this->country_id) {
            243 => 'success',
            221 => 'warning',
            14 => 'danger',
            199 => 'info',
            default => 'primary',
        };
    }

    public function getTypeLabelAttribute() {
        return match ($this->type) {
            self::TYPE_DOMESTIC => trans('payment.payment_method.domestic'),
            self::TYPE_INTERNATIONAL => trans('payment.payment_method.international'),
            default => trans('payment.payment_method.unknown'),
        };
    }

    public function getPaymentTypeLabelAttribute() {
        return match ($this->payment_type) {
            self::PAYMENT_TYPE_CASH => trans('payment.payment_method.cash'),
            self::PAYMENT_TYPE_BANKING => trans('payment.payment_method.banking'),
            self::PAYMENT_TYPE_MERCHANT => trans('payment.payment_method.merchant'),
            default => trans('payment.payment_method.unknown'),
        };
    }
}
