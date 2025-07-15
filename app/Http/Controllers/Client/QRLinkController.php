<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrLinkController extends Controller
{
    public function index()
    {
        $link = Auth::user()->qrLink;
        return view('client.headquarters.link.index', compact('link'));
    }

    public function update(Request $request)
    {
        $link = Auth::user()->qrLink;

        if (!$link) {
            abort(404);
        }

        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $filePath = $link->file_data;
        $qrData = '';

        if ($validated['file_type'] === 'link') {
            $qrData = $validated['file_data'];
        } elseif ($validated['file_type'] === 'pdf') {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->store('pdfs', 'public');
            }

            // QR tetap generate dari URL download meskipun file tidak berubah
            $qrData = route('file.download', basename($filePath));
        }

        // Generate ulang QR code
        $qrCodeSvg = \QrCode::format('svg')->size(300)->generate($qrData);

        $link->update([
            'event_name' => $validated['event_name'],
            'file_type' => $validated['file_type'],
            'file_data' => $filePath,
            'qr_code_svg' => $qrCodeSvg,
        ]);

        return redirect()->route('client.link.index')->with('success', 'QR updated successfully.');
    }



    public function edit()
    {
        $link = Auth::user()->qrLink;

        if (!$link) {
            abort(404);
        }

        return view('client.headquarters.link.edit', compact('link'));
    }
}
