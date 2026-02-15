<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'email:rfc,dns', 'max:70', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'max:100'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // if ($request->hasFile('foto')) {
        //     if ($user->peran === 'Pendaftar') {
        //         if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
        //             Storage::delete('public/' . $user->foto);
        //         }

        //         $fotoPath = $request->file('foto')->store('foto-profil', 'public');
        //         $user->foto = $fotoPath;
        //     } else {
        //         if ($user->foto && file_exists(public_path('img/profil/' . $user->foto))) {
        //             unlink(public_path('img/profil/' . $user->foto));
        //         }

        //         $filename = time() . '.' . $request->foto->extension();
        //         $request->foto->move(public_path('img/profil'), $filename);
        //         $user->foto = $filename;
        //     }
        // }

        // $user->fill($request->only('nama', 'email', 'no_hp', 'alamat'));

        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        // $user->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
