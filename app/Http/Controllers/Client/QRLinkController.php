<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\QrLink;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class QrLinkController extends Controller
{
    public function index()
    {
        $link = Auth::user()->qrLink;

        $qrData = null;
        $qrCodeSvg = null;
        $qrImageTemp = null;

        if ($link && $link->slug) {
            $qrData = route('client.qr.redirect', $link->slug);
            $qrCodeSvg = \QrCode::format('svg')->size(300)->generate($qrData);
        }

        return view('client.headquarters.link.view_link', compact('link', 'qrData', 'qrCodeSvg'));
    }

    public function edit()
    {
        $link = Auth::user()->qrLink;
        if (!$link) {
            // If no QR link exists for the user, create one.
            // This prevents the 404 and allows the user to set up their QR link.
            $link = new QrLink();
            $link->user_id = Auth::id();
            $link->event_name = 'My Event'; // Default name
            $link->file_type = 'link'; // Default type
            $link->file_data = ''; // Default data
            $link->slug = Str::random(8); // Generate initial slug
            $link->save();
            return redirect()->route('client.link.edit_link')->with('success', 'Your QR Link has been initialized. Please set it up!');
        }
        return view('client.headquarters.link.edit_link', compact('link'));
    }

    public function update(Request $request)
    {
        $link = Auth::user()->qrLink;

        // Ensure the link exists for the authenticated user
        if (!$link) {
            abort(404, 'QR link not found for this user.');
        }

        $rules = [
            'event_name' => 'required|string|max:255',
            'file_type' => 'required|in:link,pdf',
            'file_data' => 'nullable|string', // This will now come from the hidden input for 'link' type
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ];

        // Custom validation for file_data based on file_type
        if ($request->file_type === 'link') {
            $rules['file_data'] .= '|required_if:file_type,link|url'; // Validate as URL if it's a link
        } elseif ($request->file_type === 'pdf') {
            // If it's a PDF and no new file is uploaded, and there was no existing file_data, it's an error.
            // If file_data (which would be the existing PDF path) is empty AND no new file is uploaded, require a file.
            if (empty($request->input('file_data')) && !$request->hasFile('file')) {
                 $rules['file'] = 'required|file|mimes:pdf|max:2048'; // Require a file if no existing PDF data and no new upload
            }
        }

        $request->validate($rules);

        // Ensure slug exists if not already
        if (empty($link->slug)) {
            $link->slug = Str::random(8);
        }

        $updateData = [
            'event_name' => $request->event_name,
            'file_type' => $request->file_type,
            'slug' => $link->slug, // Ensure slug is always passed
        ];

        if ($request->file_type === 'pdf') {
            // Handle PDF updates
            if ($request->hasFile('file')) {
                // Delete old PDF file if it exists
                if ($link->file_data && Storage::disk('public')->exists($link->file_data)) {
                    Storage::disk('public')->delete($link->file_data);
                }
                // Store new PDF file
                $pdfPath = $request->file('file')->store('pdfs', 'public');
                $updateData['file_data'] = $pdfPath;
            } elseif ($request->input('file_data') === null) {
                // If file_data is explicitly null (e.g., "Remove Current PDF" button used)
                // and no new file is uploaded, set file_data to null/empty.
                if ($link->file_data && Storage::disk('public')->exists($link->file_data)) {
                    Storage::disk('public')->delete($link->file_data);
                }
                $updateData['file_data'] = null; // Clear the file_data
            }
            // If no new file and file_data is not null, it means keep the existing PDF.
        } elseif ($request->file_type === 'link') {
            // Handle link updates
            // If previous type was PDF, delete the old PDF file
            if ($link->file_type === 'pdf' && $link->file_data && Storage::disk('public')->exists($link->file_data)) {
                Storage::disk('public')->delete($link->file_data);
            }
            $updateData['file_data'] = $request->file_data; // Get value from the hidden input
        }

        $link->update($updateData);

        return redirect()->route('client.link.view_link')->with('success', 'Link successfully updated.');
    }

    public function redirect($slug)
    {
        $link = QrLink::where('slug', $slug)->firstOrFail();

        if ($link->file_type === 'link') {
            // Redirect to external link (e.g., Google Form, etc.)
            return redirect()->away($link->file_data);
        } elseif ($link->file_type === 'pdf') {
            // Redirect to open PDF file on the server
            $filePath = storage_path("app/public/{$link->file_data}");

            if (!file_exists($filePath)) {
                abort(404, 'File not found.');
            }

            return response()->file($filePath); // Can also use ->download() if you want to download
        }

        abort(404);
    }
}