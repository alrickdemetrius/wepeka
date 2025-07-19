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
        if (auth()->check() && auth()->user()->isAdmin()) {
            return view('admin.dashboard');
        } else {
            return view('client.index');
        }
    }
}
