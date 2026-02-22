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
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /*=============================================== SCOPES ===============================================*/
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
