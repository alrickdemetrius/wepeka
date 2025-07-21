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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoName = null;
        if ($request->hasFile('logo')) {
            $logoName = time() . '.' . $request->logo->extension();
            $request->logo->storeAs('public/logos', $logoName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password,
            'role' => 'client',
            'logo' => $logoName,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Client created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'contact_name' => 'required',
            'contact_number' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($user->logo && \Storage::disk('public')->exists($user->logo)) {
                \Storage::disk('public')->delete($user->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $user->logo = $logoPath;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'logo' => $user->logo,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus logo jika ada
        if ($user->logo && \Storage::disk('public')->exists($user->logo)) {
            \Storage::disk('public')->delete($user->logo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
