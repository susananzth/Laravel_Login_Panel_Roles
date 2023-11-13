<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'name' => 'Bolivar',
                'iso_4' => 'VEN',
                'symbol' => 'Bs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Boliviano',
                'iso_4' => 'BOB',
                'symbol' => 'Bs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dolar Estadounidense',
                'iso_4' => 'USD',
                'symbol' => '$',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peso Colombiano',
                'iso_4' => 'COP',
                'symbol' => '$',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peso Mexicano',
                'iso_4' => 'MXN',
                'symbol' => '$',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sol',
                'iso_4' => 'PEN',
                'symbol' => 'S/.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Currency::insert($currencies);

        Country::findOrFail(1)->currencies()->sync([2, 3]);
        Country::findOrFail(2)->currencies()->sync([3, 4]);
        Country::findOrFail(3)->currencies()->sync([3, 5]);
        Country::findOrFail(4)->currencies()->sync([3, 6]);
        Country::findOrFail(5)->currencies()->sync([1, 3]);
    }
}