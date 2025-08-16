<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\QrLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

class QrLinkController extends Controller
{
    public function create($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.qr.create', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->qrLink) {
            return back()->with('error', 'Client already has a QR.');
        }

        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $qrData = '';
        $filePath = null;

        if ($validated['file_type'] === 'link') {
            $qrData = $validated['file_data'];
        } elseif ($validated['file_type'] === 'pdf' && $request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('pdfs', 'public');
            $qrData = route('file.download', basename($filePath));
        }

        $qrCodeSvg = QrCode::format('svg')->size(300)->generate($qrData);

        $slug = \Str::uuid(); // atau bisa pakai \Str::random(10)

        $qrData = route('client.qr.redirect', ['slug' => $slug]); // Link tujuan via slug

        QrLink::create([
            'user_id' => $user->id,
            'event_name' => $validated['event_name'],
            'file_type' => $validated['file_type'],
            'file_data' => $filePath ?? $validated['file_data'],
            'qr_code_svg' => QrCode::format('svg')->size(300)->generate($qrData),
            'slug' => $slug, // save to DB
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'QR created successfully.');
    }

    public function show($userId)
    {
        $user = User::with('qrLink')->findOrFail($userId);

        if (!$user->qrLink) {
            return back()->with('error', 'QR not found for this client.');
        }
        $tempImage = null;
        if ($user->qrLink->temp_image_file) {
            $tempImage = $user->qrLink->temp_image_file;
        }

        return view('admin.qr.show', compact('user', 'tempImage'));
    }

    public function destroy($userId)
    {
        $user = User::with('qrLink')->findOrFail($userId);

        if (!$user->qrLink) {
            return back()->with('error', 'QR not found for this client.');
        }

        // Delete file if QR type is PDF
        if ($user->qrLink->file_type === 'pdf' && $user->qrLink->file_data) {
            Storage::disk('public')->delete($user->qrLink->file_data);
        }

        // Delete the QRLink record
        $user->qrLink->delete();

        return redirect()->route('admin.clients.index')->with('success', 'QR deleted successfully.');
    }

    public function edit($userId)
    {
        $user = User::with('qrLink')->findOrFail($userId);

        if (!$user->qrLink) {
            return redirect()->route('admin.qr.create', $userId)
                ->with('error', 'QR belum ada, silakan buat baru.');
        }

        return view('admin.qr.edit', compact('user'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::with('qrLink')->findOrFail($userId);

        if (!$user->qrLink) {
            return redirect()->route('admin.qr.create', $userId)
                ->with('error', 'QR belum ada, silakan buat baru.');
        }

        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $filePath = $user->qrLink->file_data;

        // Jika update PDF
        if ($validated['file_type'] === 'pdf' && $request->hasFile('file')) {
            if ($user->qrLink->file_type === 'pdf' && $user->qrLink->file_data) {
                Storage::disk('public')->delete($user->qrLink->file_data);
            }

            $file = $request->file('file');
            $filePath = $file->store('pdfs', 'public');
        }

        // Data QR baru
        $qrData = $validated['file_type'] === 'link'
            ? $validated['file_data']
            : route('file.download', basename($filePath));

        $slug = $user->qrLink->slug; // tetap pakai slug lama
        $qrData = route('client.qr.redirect', ['slug' => $slug]);

        // Update record
        $user->qrLink->update([
            'event_name' => $validated['event_name'],
            'file_type' => $validated['file_type'],
            'file_data' => $filePath ?? $validated['file_data'],
            'qr_code_svg' => QrCode::format('svg')->size(300)->generate($qrData),
        ]);

        return redirect()->route('admin.qr.show', $userId)->with('success', 'QR updated successfully.');
    }


    public function downloadSvg($id)
    {
        $qrLink = QrLink::where('user_id', $id)->firstOrFail();

        $svgContent = $qrLink->qr_code_svg;
        $fileName = 'qr_' . $qrLink->user->name . '.svg';

        return Response::make($svgContent, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}
