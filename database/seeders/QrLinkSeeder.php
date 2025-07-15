<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QrLink;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class QrLinkSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // ambil user pertama (pastikan ada)

        if (!$user) {
            $user = User::create([
                'name' => 'Dummy User',
                'email' => 'dummy@example.com',
                'password' => bcrypt('password'),
                'role' => 'client',
            ]);
        }

        // Tambahkan dummy data untuk tipe "link"
        QrLink::create([
            'user_id' => $user->id,
            'event_name' => 'Wepeka Online Event',
            'file_type' => 'link',
            'file_data' => 'https://example.com/event-info',
            'qr_code_svg' => \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(300)->generate('https://example.com/event-info'),
        ]);

        // Tambahkan dummy data untuk tipe "pdf"
        $pdfFilename = 'pdfs/' . Str::random(20) . '.pdf';

        // Buat file dummy PDF
        \Storage::disk('public')->put($pdfFilename, file_get_contents(resource_path('dummy.pdf'))); // kamu bisa copykan dummy.pdf ke `resources/`

        $pdfDownloadLink = url('/download/' . basename($pdfFilename));

        QrLink::create([
            'user_id' => $user->id,
            'event_name' => 'Wepeka PDF Guide',
            'file_type' => 'pdf',
            'file_data' => $pdfFilename,
            'qr_code_svg' => \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(300)->generate($pdfDownloadLink),
        ]);
    }
}
