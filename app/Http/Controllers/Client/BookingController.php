<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class BookingController extends Controller
{
    public function index()
    {
        $featuredPortfolios = Portfolio::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();
        return view('client.booking', compact('featuredPortfolios'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'required|string|max:20',
            'service_type' => 'required|array',
            'message'      => 'required|string',
        ]);

        Booking::create([
            'company_name'  => $validated['company_name'],
            'contact_name'  => $validated['contact_name'],
            'email'         => $validated['email'],
            'phone'         => $validated['phone'],
            'service_types' => $validated['service_type'],
            'message'       => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'Your booking request has been sent! We will contact you soon.');
    }
}
