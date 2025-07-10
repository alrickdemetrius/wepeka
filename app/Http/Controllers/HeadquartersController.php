<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadquartersController extends Controller
{
    public function index()
    {
        return view('client.headquarters.index');
    }
}
