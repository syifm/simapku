<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Preferensi;
use App\Models\Wisatawan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function tampilkanProfil()
    {
        $user = Auth::user();
        $wisatawan = Wisatawan::where('user_id', $user->id)->first();
        // if ($wisatawan) {
        //     $wisatawan = Wisatawan::where('user_id', $user->id)->first();

        //     $preferensi = Preferensi::with('kategori')
        //         ->where('id_wisatawan', $wisatawan->id_wisatawan)
        //         ->orderByDesc('jumlah')
        //         ->get();
        // } else {
        //     $preferensi = collect();
        // }
        return view('profile.show', compact('user', 'wisatawan'));
    }

    public function tampilkanEditProfil(Request $request): View
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

    public function updateDetail(Request $request)
    {
        // $user = Auth::user();
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'email:rfc,dns', 'max:70', Rule::unique('users')->ignore($user->id)],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email ini sudah digunakan',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus JPEG, PNG, JPG',
            'foto.max' => 'Ukuran foto maksimal 2 MB',
        ]);

        if ($request->hasFile('foto')) {

            if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                Storage::delete('public/' . $user->foto);
            }

            $fotoPath = $request->file('foto')->store('foto-profil', 'public');

            $user->foto = $fotoPath;
        }

        $user->nama = $request->nama;
        $user->email = $request->email;

        if (!$user->isDirty()) {
            return Redirect::route('profile.edit')->with('swal', [
                'title' => 'Info',
                'text' => 'Tidak terdapat perubahan',
                'icon' => 'info',
            ]);
        }
        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'current_password.current_password' => 'Password saat ini tidak sesuai',
            'password.required' => 'Password baru wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min' => 'Password minimal 8 karakter',
            'password.mixed' => 'Password harus mengandung huruf besar dan kecil',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka',
            'password.symbols' => 'Password harus mengandung setidaknya satu simbol',
        ]);

        if (Hash::check($validated['password'], $request->user()->password)) {
            return back()->with('swal', [
                'title' => 'Info',
                'text' => 'Password tidak terdapat perubahan',
                'icon' => 'info',
            ]);
        }

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
