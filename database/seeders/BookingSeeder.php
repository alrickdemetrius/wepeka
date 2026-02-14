<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = [
            [
                'company_name'  => 'Global Tech Solutions',
                'contact_name'  => 'Alrick Demetrius',
                'email'         => 'alrick@globaltech.com',
                'phone'         => '081234567890',
                'message'       => 'Kami butuh website company profile dan desain logo baru.',
                'status'        => 'pending',
            ],
            [
                'company_name'  => 'Coffee Shop ID',
                'contact_name'  => 'Michael Davids',
                'email'         => 'michael@coffeeshop.id',
                'phone'         => '089876543210',
                'message'       => 'Persiapan launching cabang baru, butuh promosi digital dan seragam karyawan.',
                'status'        => 'pending',
            ],
            [
                'company_name'  => 'Creative Studio',
                'contact_name'  => 'Sarah Wijaya',
                'email'         => 'sarah@creative.com',
                'phone'         => '085566778899',
                'message'       => 'Hanya ingin konsultasi mengenai re-branding identitas visual.',
                'status'        => 'pending',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}