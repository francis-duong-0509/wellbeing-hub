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

    public function states(): HasMany {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    /*=============================================== SCOPES ===============================================*/
    public function scopeActive(Builder $query) {
        return $query->where('is_active', 1);
    }

    /*=============================================== METHODS ===============================================*/
    public static function getDefaultLanguages(?int $countryId) {
        $country = self::find($countryId);

        if (!$country) return [];

        \Log::info('Language Code: ', $country->languages()->pluck('name', 'code')->toArray());

        return $country->languages()->pluck('name', 'code')->toArray();
    }

    public static function getActiveCountries() {
        return self::active()->pluck('name', 'id')->toArray();
    }
}
