<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    //
    public function index()
    {
        $cur_user = User::find(Auth::id());
        return view('client.headquarters.profile.index', compact("cur_user"));
    }

}
