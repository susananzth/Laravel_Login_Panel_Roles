<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Bolivia',
                'iso_2' => 'BO',
                'iso_3' => 'BOL',
                'iso_number' => '068',
                'phone_code' => '591',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Colombia',
                'iso_2' => 'CO',
                'iso_3' => 'COL',
                'iso_number' => '170',
                'phone_code' => '57',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'México',
                'iso_2' => 'MX',
                'iso_3' => 'MEX',
                'iso_number' => '484',
                'phone_code' => '52',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perú',
                'iso_2' => 'PE',
                'iso_3' => 'PER',
                'iso_number' => '604',
                'phone_code' => '51',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Venezuela',
                'iso_2' => 'VE',
                'iso_3' => 'VEN',
                'iso_number' => '862',
                'phone_code' => '58',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Country::insert($countries);
    }
}