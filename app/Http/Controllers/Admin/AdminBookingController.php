<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        // urut dari yang terbaru ke terlama
        $bookings = Booking::with('jenisLayanans')->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking #' . $id . ' berhasil diperbarui.');
    }
}
