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
            //proses ke halaman admin
        }
        return view('client.index');
    }
}
