<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    //
    public function index()
    {
        return view('client.headquarters.profile.index');
    }

}
