<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nnjeim\World\Models\State as StateModel;

class State extends StateModel
{
    use HasFactory;

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function country(): BelongsTo {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /*=============================================== SCOPES ===============================================*/
    public function scopeGetCountry(Builder $query, $countryId) {
        return $query->where('country_id', $countryId);
    }
}
