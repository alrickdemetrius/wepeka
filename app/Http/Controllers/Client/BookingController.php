<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\JenisLayanan;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $featuredPortfolios = Portfolio::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();
        
        $jenisLayanans = JenisLayanan::all();
        
        return view('client.booking', compact('featuredPortfolios', 'jenisLayanans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'required|string|max:20',
            'service_type' => 'required|array|min:1',
            'service_type.*' => 'exists:jenis_layanans,id',
            'message'      => 'required|string',
        ]);

        DB::beginTransaction();
        
        try {
            // Create booking
            $booking = Booking::create([
                'company_name'  => $validated['company_name'],
                'contact_name'  => $validated['contact_name'],
                'email'         => $validated['email'],
                'phone'         => $validated['phone'],
                'message'       => $validated['message'],
            ]);

            // Create booking details
            foreach ($validated['service_type'] as $jenisLayananId) {
                BookingDetail::create([
                    'booking_id' => $booking->id,
                    'jenis_layanan_id' => $jenisLayananId,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Your booking request has been sent! We will contact you soon.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}