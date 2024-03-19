<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.string' => 'L\'indirizzo email deve essere una stringa.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'email.max' => 'L\'indirizzo email non può superare i 255 caratteri.',
            'email.unique' => 'Questo indirizzo email è già in uso.',
            'password.required' => 'Il campo password è obbligatorio.',
            'password.confirmed' => 'La conferma della password non corrisponde.',
            'password.min' => 'La password deve contenere almeno :min caratteri.',
            'password.password' => 'La password deve contenere almeno una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
