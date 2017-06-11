<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name', 'cp',
    ];

    /**
     * Devuelve el Estado o Provincia al que pertenece la Ciudad.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state() {
        return $this->belongsTo(State::class);
    }
}
