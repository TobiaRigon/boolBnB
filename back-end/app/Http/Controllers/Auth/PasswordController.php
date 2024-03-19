<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'Il campo password attuale è obbligatorio.',
            'current_password.password' => 'La password attuale non è corretta.',
            'password.required' => 'Il campo nuova password è obbligatorio.',
            'password.confirmed' => 'La conferma della nuova password non corrisponde.',
            'password.min' => 'La nuova password deve contenere almeno :min caratteri.',
            'password.password' => 'La nuova password deve contenere almeno una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
