<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $document_types = [
            [
                'name'   => 'Cédula',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'   => 'RIF',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'   => 'Pasaporte',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DocumentType::insert($document_types);
    }
}
