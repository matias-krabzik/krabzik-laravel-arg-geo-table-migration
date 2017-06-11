<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable =[
        'name', 'full_name', 'phone_code',
    ];

    /**
     * Devuelve todas las provincias o estados de un pais.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states() {
        return $this->hasMany(State::class);
    }

    /**
     * Devuelve la capital del pais.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function capital() {
        return $this->hasOne(City::class);
    }
}
