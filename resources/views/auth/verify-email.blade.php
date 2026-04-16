<x-guest-layout>
    <div class="auth_intro">
        {{ __('Merci pour votre inscription ! Avant de commencer, veuillez verifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer. Si vous ne l\'avez pas recu, nous pouvons vous en renvoyer un.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth_status">
            {{ __('Un nouveau lien de verification a ete envoye a votre adresse email.') }}
        </div>
    @endif

    <div class="auth_actions">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Renvoyer l\'email de verification') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="auth_link auth_link--button">
                {{ __('Se deconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>
