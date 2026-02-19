<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['is_active'];

    protected $casts = ['is_active' => 'boolean'];

    const UPDATED_AT = null;

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function currencies(): HasMany {
        return $this->hasMany(Currency::class, 'country_id', 'id');
    }

    public function languages(): BelongsToMany {
        return $this->belongsToMany(Language::class, 'country_language');
    }

    /*=============================================== SCOPES ===============================================*/
    public function scopeActive(Builder $query) {
        return $query->where('is_active', 1);
    }
}
