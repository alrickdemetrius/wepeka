<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisLayananSeeder extends Seeder
{
    public function run(): void
    {
        $jenisLayanans = [
            [
                'nama' => 'Apparel & Product',
                'deskripsi' => 'Kami membuat seragam dan merchandise brand dengan desain kekinian. Apparel dapat dilengkapi QR Code yang terhubung ke website, campaign, atau company profile menjadikan pakaian sebagai media branding yang fungsional.',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Website',
                'deskripsi' => 'Kami membangun website brand sebagai pusat digital, mulai dari company profile hingga fitur custom sesuai kebutuhan. Website dirancang modern, fleksibel, dan terintegrasi dengan QR pada apparel.',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Brand Identity System',
                'deskripsi' => 'Kami merancang identitas visual brand secara menyeluruh, mulai dari logo, maskot, hingga brand guidelines dan brand book, agar brand tampil konsisten dan profesional di semua media.',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('jenis_layanans')->insert($jenisLayanans);
    }
}