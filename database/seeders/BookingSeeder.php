<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking; // Import Model Booking

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'company_name'  => 'Global Tech Solutions',
                'contact_name'  => 'Alrick Demetrius',
                'email'         => 'alrick@globaltech.com',
                'phone'         => '081234567890',
                'service_types' => ['website', 'branding'], 
                'message'       => 'Kami butuh website company profile dan desain logo baru.',
                'status'        => 'pending',
            ],
            [
                'company_name'  => 'Coffee Shop ID',
                'contact_name'  => 'Michael Davids',
                'email'         => 'michael@coffeeshop.id',
                'phone'         => '089876543210',
                'service_types' => ['marketing', 'jingle', 'apparel'],
                'message'       => 'Persiapan launching cabang baru, butuh promosi digital dan seragam karyawan.',
                'status'        => 'pending',
            ],
            [
                'company_name'  => 'Creative Studio',
                'contact_name'  => 'Sarah Wijaya',
                'email'         => 'sarah@creative.com',
                'phone'         => '085566778899',
                'service_types' => ['branding'],
                'message'       => 'Hanya ingin konsultasi mengenai re-branding identitas visual.',
                'status'        => 'pending',
            ],
        ];

        foreach ($data as $booking) {
            Booking::create($booking);
        }
    }
}