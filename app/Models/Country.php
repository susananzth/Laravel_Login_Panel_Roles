<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso_2',
        'iso_3',
        'iso_number',
        'phone_code',
    ];

    /**
     * The currencies that belong to the country.
     */
    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(Currency::class, 'country_currency');
    }

    /**
     * Get the states for the country.
     */
    public function states(): hasMany
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get the users for the country.
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class, 'phone_code_id');
    }
}
