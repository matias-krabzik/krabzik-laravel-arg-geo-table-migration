<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name', 'full_name', 'country_id',
    ];

    /**
     * Devuelve el pais al que pertenece la Provincia o Estado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country() {
        return $this->belongsTo(Country::class);
    }

    /**
     * Devuelve las ciudades pertenecientes a la Provincia o Estado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities() {
        return $this->hasMany(City::class);
    }
}
