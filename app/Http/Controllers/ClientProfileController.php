<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;     // ✅ Tambahkan ini
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ClientProfileController extends Controller
{
    //
    public function index()
    {
        $cur_user = User::find(Auth::id());
        return view('client.headquarters.profile.profile', compact("cur_user"));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::id());

        // Jika upload logo baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama kalau ada
            if ($user->logo && \Storage::disk('public')->exists($user->logo)) {
                \Storage::disk('public')->delete($user->logo);
            }

            // Simpan logo baru
            $logoPath = $request->file('logo')->store('logos', 'public');
            $user->logo = $logoPath;
        }

        $user->update([
            'name' => $request->name,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'logo' => $user->logo,
        ]);

        return redirect()->route('client.profile')->with('success', 'Profile updated successfully!');
    }

    public function deleteLogo()
    {
        $user = User::find(Auth::id());

        if ($user->logo && \Storage::disk('public')->exists($user->logo)) {
            \Storage::disk('public')->delete($user->logo);
            $user->update(['logo' => null]);
        }

        return redirect()->route('client.profile')->with('success', 'Logo deleted successfully!');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ],
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('client.profile')->with('success', 'Email updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('client.profile')->with('error', 'Current password is incorrect!');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('client.profile')->with('success', 'Password updated successfully!');
    }
}
