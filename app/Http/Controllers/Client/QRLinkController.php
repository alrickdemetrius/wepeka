<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\QrLink;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrLinkController extends Controller
{
    public function index()
    {
        $link = Auth::user()->qrLink;

        if (!$link) {
            abort(404, 'QR link belum tersedia.');
        }

        if (!$link->slug) {
            $link->slug = Str::random(8);
            $link->save();
        }

        $qrData = route('client.qr.redirect', $link->slug);
        $qrCodeSvg = QrCode::format('svg')->size(300)->generate($qrData);

        return view('client.headquarters.link.view_link', compact('link', 'qrData', 'qrCodeSvg'));
    }

    public function edit()
    {
        $link = Auth::user()->qrLink;
        if (!$link) {
            abort(404, 'QR link belum tersedia.');
        }
        return view('client.headquarters.link.edit_link', compact('link'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'required_if:file_type,link|nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $link = Auth::user()->qrLink;

        if (!$link->slug) {
            $link->slug = Str::random(8);
        }

        if ($request->file_type === 'pdf') {
            if ($request->hasFile('file')) {
                // Hapus file lama
                if ($link->file_data && file_exists(storage_path("app/{$link->file_data}"))) {
                    unlink(storage_path("app/{$link->file_data}"));
                }

                // Simpan file baru
                $pdfPath = $request->file('file')->store('public/pdfs');
                $link->file_data = $pdfPath;
            }
            // Jika tidak ada file baru, file_data tetap
        } elseif ($request->file_type === 'link') {
            $link->file_data = $request->file_data;
        }

        $link->update([
            'event_name' => $request->event_name,
            'file_type' => $request->file_type,
            'slug' => $link->slug,
            'file_data' => $link->file_data,
        ]);

        return redirect()->route('client.link.view_link')->with('success', 'Link berhasil diperbarui.');
    }

    public function redirect($slug)
{
    $link = QrLink::where('slug', $slug)->firstOrFail();

    if ($link->file_type === 'link') {
        // Redirect ke link luar (misalnya Google Form, dll)
        return redirect()->away($link->file_data);
    } elseif ($link->file_type === 'pdf') {
        // Redirect untuk membuka file PDF di server
        $filePath = storage_path("app/public/{$link->file_data}");

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($filePath); // Bisa juga pakai ->download() jika ingin diunduh
    }

    abort(404);
}
}
