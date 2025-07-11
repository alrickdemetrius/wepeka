<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLinkController extends Controller
{
    public function index()
    {
        $cur_user = User::find(Auth::id());
        return view('client.headquarters.link.index', compact("cur_user"));
    }
}
