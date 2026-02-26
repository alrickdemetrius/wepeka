<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    public function index()
    {
        // Senin - Minggu pada minggu saat admin login
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek   = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        // Booking minggu ini, terbaru ke terlama
        $bookingsThisWeek = Booking::with('jenisLayanans')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->latest()
            ->get();

        // Semua booking, terbaru ke terlama
        $bookings = Booking::with('jenisLayanans')->latest()->get();

        return view('admin.bookings.index', compact(
            'bookings',
            'bookingsThisWeek',
            'startOfWeek',
            'endOfWeek'
        ));
    }

    public function show($id)
    {
        $booking = Booking::with('jenisLayanans')->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
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