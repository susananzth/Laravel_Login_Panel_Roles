<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso_4',
        'symbol',
    ];

    /**
     * The countries that belong to the currency.
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'country_currency');
    }
}
