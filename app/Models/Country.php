<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}


