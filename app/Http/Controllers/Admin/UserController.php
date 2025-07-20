<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'client')->latest()->get();
        return view('admin.dashboard', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password, // Simpan password asli
            'role' => 'client',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Client created successfully');
    }
}
