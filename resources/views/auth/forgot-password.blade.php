<x-guest-layout>
    <div class="auth_intro">
        {{ __('Mot de passe oublie ? Aucun souci. Indiquez votre adresse email et nous vous enverrons un lien pour reinitialiser votre mot de passe.') }}
    </div>

    <!-- statut de session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- adresse email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- action principale -->
        <div class="auth_actions">
            <x-primary-button>
                {{ __('Envoyer le lien de reinitialisation') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
