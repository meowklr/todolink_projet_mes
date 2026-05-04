<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
        * Affiche la page de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
        * Traite une requete d'authentification.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // verifie les identifiants via la requete
        $request->authenticate();

        // regenere la session pour eviter la fixation
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
        * Met fin a la session authentifiee.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
