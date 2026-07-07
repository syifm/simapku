<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Wisatawan;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function tampilkanRegistrasiAkun(): View
    {
        return view('auth.registrasiakun');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function simpan(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:70', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'email.lowercase' => 'Email harus menggunakan huruf kecil',
            'email.unique' => 'Email sudah digunakan',
            'password.confirmed' => 'Password dan konfirmasi password tidak sama',
            'password.min' => 'Password minimal 8 karakter',
            'password.mixed' => 'Password harus mengandung huruf besar dan kecil',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka',
            'password.symbols' => 'Password harus mengandung setidaknya satu simbol',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'peran' => 'Wisatawan',
        ]);

        // Wisatawan::create([
        //     'user_id' => $user->id,
        //     'asal_kota' => $request->asal_kota,
        // ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('beranda-Wisatawan', absolute: false));
    }
}
