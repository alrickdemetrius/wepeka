<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingDetail;
use App\Models\Booking;
use App\Models\JenisLayanan;

class BookingDetailSeeder extends Seeder
{
    public function run(): void
    {
        $booking1 = Booking::where('email', 'alrick@globaltech.com')->first();
        $booking2 = Booking::where('email', 'michael@coffeeshop.id')->first();
        $booking3 = Booking::where('email', 'sarah@creative.com')->first();

        if ($booking1) {
            // Global Tech Solutions: Website + Branding
            BookingDetail::create([
                'booking_id' => $booking1->id,
                'jenis_layanan_id' => 2, // Website
            ]);
            BookingDetail::create([
                'booking_id' => $booking1->id,
                'jenis_layanan_id' => 3, // Brand Identity System
            ]);
        }

        if ($booking2) {
            // Coffee Shop ID: Apparel + Website
            BookingDetail::create([
                'booking_id' => $booking2->id,
                'jenis_layanan_id' => 1, // Apparel & Product
            ]);
            BookingDetail::create([
                'booking_id' => $booking2->id,
                'jenis_layanan_id' => 2, // Website
            ]);
        }

        if ($booking3) {
            // Creative Studio: Branding only
            BookingDetail::create([
                'booking_id' => $booking3->id,
                'jenis_layanan_id' => 3, // Brand Identity System
            ]);
        }
    }
}