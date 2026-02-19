<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'course_type_id',
        'fromdate',
        'todate',
        'price',
        'discount_type',
        'discount_price',
        'discount_until',
        'capacity',
        'is_active',
        'image',
        'available_payment_method',
        'description',
        'limit_registration',
        'country_id',
        'created_by',
        'teacher_id',
        'currency_id',
        'language_code',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'fromdate' => 'datetime',
        'todate' => 'datetime',
        'discount_until' => 'datetime',
        'price' => 'float',
        'discount_price' => 'float',
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function courseType(): BelongsTo {
        return $this->belongsTo(CourseType::class, 'course_type_id', 'id');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function teacher(): BelongsTo {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function currency(): BelongsTo {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    /*=============================================== SCOPES ===============================================*/
    public function scopeActive(Builder $query) {
        return $query->where('is_active', 1);
    }

    /*=============================================== HELPER METHODS ===============================================*/
}
