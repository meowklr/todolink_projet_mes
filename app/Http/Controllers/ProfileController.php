<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
        * Affiche le formulaire de profil de l'utilisateur.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
        * Met a jour les informations de profil de l'utilisateur.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // applique les champs valides au profil
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            // reset verification si l'email change
            $request->user()->email_verified_at = null;
        }

        // sauvegarde des changements
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
        * Supprime le compte utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // securise la suppression avec le mot de passe courant
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // deconnecte avant suppression
        Auth::logout();

        $user->delete();

        // invalide la session et regenere le token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
