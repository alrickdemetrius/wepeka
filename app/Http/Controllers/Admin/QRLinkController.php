<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\QrLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        QrLink::create([
            'user_id' => $user->id,
            'event_name' => $validated['event_name'],
            'file_type' => $validated['file_type'],
            'file_data' => $filePath ?? $validated['file_data'],
            'qr_code_svg' => $qrCodeSvg,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'QR created successfully.');
    }

    public function show($userId)
{
    $user = User::with('qrLink')->findOrFail($userId);

    if (!$user->qrLink) {
        return back()->with('error', 'QR not found for this client.');
    }

    return view('admin.qr.show', compact('user'));
}
}
