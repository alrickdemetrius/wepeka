<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingDetail;
use App\Models\Booking;
use App\Models\PortfolioCategory; // Ganti ini

class BookingDetailSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data booking berdasarkan email yang di-seed di UserSeeder/BookingSeeder
        $booking1 = Booking::where('email', 'alrick@globaltech.com')->first();
        $booking2 = Booking::where('email', 'michael@coffeeshop.id')->first();
        $booking3 = Booking::where('email', 'sarah@creative.com')->first();

        // Ambil ID Kategori agar tidak hardcoded (lebih aman)
        $catWebsite = PortfolioCategory::where('name', 'Website Design')->first()?->id;
        $catGraphic = PortfolioCategory::where('name', 'Graphic Design')->first()?->id;
        $catApparel = PortfolioCategory::where('name', 'Apparel Design')->first()?->id;

        if ($booking1 && $catWebsite && $catGraphic) {
            // Global Tech Solutions: Website + Graphic Design
            BookingDetail::create([
                'booking_id' => $booking1->id,
                'portfolio_category_id' => $catWebsite,
            ]);
            BookingDetail::create([
                'booking_id' => $booking1->id,
                'portfolio_category_id' => $catGraphic,
            ]);
        }

        if ($booking2 && $catApparel && $catWebsite) {
            // Coffee Shop ID: Apparel + Website
            BookingDetail::create([
                'booking_id' => $booking2->id,
                'portfolio_category_id' => $catApparel,
            ]);
            BookingDetail::create([
                'booking_id' => $booking2->id,
                'portfolio_category_id' => $catWebsite,
            ]);
        }

        if ($booking3 && $catGraphic) {
            // Creative Studio: Graphic Design only
            BookingDetail::create([
                'booking_id' => $booking3->id,
                'portfolio_category_id' => $catGraphic,
            ]);
        }
    }
}