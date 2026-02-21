<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

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
        'thumbnail',
        'available_payment_methods',
        'description',
        'limit_registration',
        'country_id',
        'state_id',
        'created_by',
        'teacher_id',
        'currency_id',
        'language_code',
        'created_at',
        'updated_at',
        'modified_at',
        'modified_by',
        'deleted_by',
        'available_for',
        'require_referral',
        'has_commission',
        'enable_registration',
        'is_vip',
    ];

    const COURSE_TYPE_OFFLINE = 'offline';
    const COURSE_TYPE_ONLINE = 'online';
    const IS_RETREAT_NO_LIMIT = 'no_limit';
    const IS_RETREAT_ONLY_RETREAT = 'only_retreat';
    const IS_RETREAT_ONLY_FIRE_GATHERING = 'only_fire_gathering';

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function courseType(): BelongsTo {
        return $this->belongsTo(CourseType::class, 'course_type_id', 'id');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state(): BelongsTo {
        return $this->belongsTo(State::class, 'state_id', 'id');
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
