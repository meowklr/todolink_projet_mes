<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
        * Affiche la page de confirmation du mot de passe.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
        * Confirme le mot de passe de l'utilisateur.
     */
    public function store(Request $request): RedirectResponse
    {
        // verifie le mot de passe avant action sensible
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // memorise la confirmation recente
        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
