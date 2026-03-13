<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Website Design',
            'Graphic Design',
            'Digital Marketing',
            'Jingle',
            'Apparel Design',
        ];

        foreach ($categories as $cat) {
            PortfolioCategory::updateOrCreate(['name' => $cat]);
        }
    }
}