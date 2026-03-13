<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sesuaikan 'nama_brand' di bawah ini dengan nama kolom di migrasi kamu (misal: 'name')
        \App\Models\Brand::create([
            'name' => 'Familia Basketball'
        ]);

        \App\Models\Brand::create([
            'name' => 'Universitas Ciputra'
        ]);
    }
}
