<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email'],
            'password' => ['required','confirmed',Rules\Password::defaults()],
        ]);

        try {

            /*
            |--------------------------------------------------------------------------
            | CREATE USER DI FIREBASE
            |--------------------------------------------------------------------------
            */

            $firebaseAuth = app('firebase.auth');

            $firebaseUser = $firebaseAuth->createUser([
                'email' => $request->email,
                'password' => $request->password,
                'displayName' => $request->name,
            ]);

            /*
            |--------------------------------------------------------------------------
            | SIMPAN USER KE DATABASE LARAVEL
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'firebase_uid' => $firebaseUser->uid,
                'role' => 'user',
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Throwable $e) {

            return back()->withErrors([
                'email' => 'Register gagal: '.$e->getMessage()
            ])->withInput();

        }
    }
}