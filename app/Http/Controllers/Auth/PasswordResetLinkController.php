<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
        * Affiche la page de demande de lien de reinitialisation.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
        * Traite une demande de lien de reinitialisation.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // demande l'envoi du lien de reinitialisation
        // On envoie le lien de reinitialisation. Ensuite on lit le statut pour
        // afficher le bon message a l'utilisateur.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
