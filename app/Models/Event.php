<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price',
        'discount_percent',
        'discount_until',
        'type',
        'fromdate',
        'todate',
        'country_id',
        'is_active',
        'description',
        'image',
        'available_payment_method',
        'created_by',
        'language_code',
        'currency_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'price' => 'float',
        'fromdate' => 'datetime',
        'todate' => 'datetime',
        'discount_percent' => 'decimal:2',
        'discount_until' => 'datetime',
        'is_active' => 'boolean',
    ];

    /*=============================================== RELATIONSHIPS ===============================================*/

}
