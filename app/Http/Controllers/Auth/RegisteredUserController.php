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
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:70', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'preferensi' => 'nullable|string',
        ], [
            'password.confirmed' => 'Password dan konfirmasi password tidak sama',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Wisatawan',
        ]);

        Wisatawan::create([
            'user_id' => $user->id,
            'preferensi' => $request->preferensi,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('beranda-Wisatawan', absolute: false));
    }
}
