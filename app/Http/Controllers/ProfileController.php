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

    // 1. Ambil data dari request
    $user->name = $request->name;
    $user->email = $request->email;
    $user->nomor_hp = $request->nomor_hp;
    $user->alamat = $request->alamat;

    // 2. Logika Foto Profil
    if ($request->hasFile('foto_profil')) {
        if ($user->foto_profil) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('profiles/' . $user->foto_profil);
        }

        $file = $request->file('foto_profil');
        $nama_file = time() . '_' . $file->getClientOriginalName();

        // Simpan ke storage/app/public/profiles
        $file->storeAs('profiles', $nama_file, 'public');

        $user->foto_profil = $nama_file;
    }

    // 3. Simpan permanen ke database
    $user->save();

    return redirect()->route('profile.edit')->with('status', 'profile-updated');
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
