<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'type',
        'time',
        'description',
        'is_done',
        'is_done_at',
        'is_active',
        'image',
        'discount_type',
        'discount_price',
        'discount_until',
        'available_payment_method',
        'country_id',
        'created_by',
        'currency_id',
        'language_code',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'price' => 'float',
        'discount_price' => 'float',
        'time' => 'integer',
        'is_done' => 'boolean',
        'is_done_at' => 'datetime',
        'is_active' => 'boolean',
        'discount_until' => 'datetime',
    ];

    /*=============================================== RELATIONSHIPS ===============================================*/
}
