<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return view('admin.dashboard');
            } else {
                return view('client.headquarters.index');
            }
        }

        // Jika belum login
        return view('home');
    }
}
