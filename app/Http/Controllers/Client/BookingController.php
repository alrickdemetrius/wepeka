<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
}
