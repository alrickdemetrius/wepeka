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
                'phone'         => '089603678494',
                'message'       => 'Kami butuh website company profile dan desain logo baru.',
                'status'        => 'pending',
            ],
            [
                'company_name'  => 'Coffee Shop ID',
                'contact_name'  => 'Michael Davids',
                'email'         => 'michael@coffeeshop.id',
                'phone'         => '08115912599',
                'message'       => 'Persiapan launching cabang baru, butuh promosi digital dan seragam karyawan.',
                'status'        => 'pending',
            ],
            [
                'company_name'  => 'Creative Studio',
                'contact_name'  => 'Surya Wijaya',
                'email'         => 'surya@creative.com',
                'phone'         => '081231415110',
                'message'       => 'Hanya ingin konsultasi mengenai re-branding identitas visual.',
                'status'        => 'pending',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}