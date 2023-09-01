<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'iso_2',
    ];

    /**
     * Get the country that owns the state.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the cities for the state.
     */
    public function cities(): hasMany
    {
        return $this->hasMany(City::class);
    }
}
