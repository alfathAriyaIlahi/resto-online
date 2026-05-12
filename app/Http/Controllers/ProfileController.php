<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit_user', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Ambil data manual satu per satu untuk memastikan
    $user->name = $request->name;
    $user->email = $request->email;
    $user->nomor_hp = $request->nomor_hp;
    $user->alamat = $request->alamat;

    if ($request->hasFile('foto_profil')) {
        if ($user->foto_profil) {
            \Illuminate\Support\Facades\Storage::delete('public/profiles/' . $user->foto_profil);
        }
        $nama_file = time() . '_' . $request->file('foto_profil')->getClientOriginalName();
        $request->file('foto_profil')->storeAs('public/profiles', $nama_file);
        $user->foto_profil = $nama_file;
    }

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Gunakan update() atau save()
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        if ($user->foto_profil) {
            Storage::delete('public/profiles/' . $user->foto_profil);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
