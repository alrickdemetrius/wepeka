<?php

namespace App\Http\Controllers;

use App\Models\QrLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ClientLinkController extends Controller
{
    public function index()
    {
        $cur_user = User::find(Auth::id());
        $links = QrLink::where('user_id', $cur_user->id)->latest()->get();

        return view('client.headquarters.link.index', compact('cur_user', 'links'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'event_name' => $request->event_name,
            'file_type' => $request->file_type,
        ];

        if ($request->file_type === 'link') {
            $data['file_data'] = $request->file_data;
        } elseif ($request->file_type === 'pdf' && $request->hasFile('file')) {
            $path = $request->file('file')->store('pdfs', 'public');
            $data['file_data'] = $path;
        }

        if ($data['file_type'] === 'link') {
            $url = $data['file_data'];
        } else {
            $filename = basename($data['file_data']);
            $url = url('/download/' . $filename);
        }

        // Generate QR code as SVG
        $qrSvg = QrCode::format('svg')->size(300)->generate($url);
        $data['qr_code_svg'] = $qrSvg;

        // Save to DB
        $qrLink = QrLink::create($data);

        // Redirect to preview page with QR
        return view('client.headquarters.link.qr_preview', [
            'qr' => $qrSvg,
            'event_name' => $data['event_name'],
            'url' => $url,
        ]);
    }

    public function edit($id)
    {
        $link = QrLink::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('client.headquarters.link.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $link = QrLink::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $link->event_name = $request->event_name;
        $link->file_type = $request->file_type;

        if ($request->file_type === 'link') {
            $link->file_data = $request->file_data;
            $url = $link->file_data;
        } elseif ($request->file_type === 'pdf' && $request->hasFile('file')) {
            $path = $request->file('file')->store('pdfs', 'public');
            $link->file_data = $path;
            $url = asset('storage/' . $path);
        } else {
            $url = $link->file_type === 'pdf'
                ? asset('storage/' . $link->file_data)
                : $link->file_data;
        }

        $link->qr_code_svg = QrCode::format('svg')->size(300)->generate($url);
        $link->save();

        return redirect()->route('client.link')->with('success', 'QR Link updated successfully.');
    }

    public function destroy($id)
    {
        $link = QrLink::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $link->delete();

        return redirect()->route('client.link')->with('success', 'QR Link deleted.');
    }
}
