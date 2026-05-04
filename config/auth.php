<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Parametres d'authentification par defaut
    |--------------------------------------------------------------------------
    |
    | Cette option definit le "guard" et le "broker" de reinitialisation
    | par defaut. Vous pouvez les modifier selon vos besoins.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards d'authentification
    |--------------------------------------------------------------------------
    |
    | Vous pouvez definir chaque guard d'authentification.
    | Une configuration par defaut est fournie avec session + provider Eloquent.
    |
    | Chaque guard utilise un provider qui definit comment les utilisateurs
    | sont recuperes (base de donnees ou autre stockage). Eloquent est courant.
    |
    | Supporte : "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Providers d'utilisateurs
    |--------------------------------------------------------------------------
    |
    | Tous les guards utilisent un provider qui definit comment recuperer
    | les utilisateurs (base ou autre). Eloquent est le plus courant.
    |
    | Si vous avez plusieurs tables ou modeles, vous pouvez definir
    | plusieurs providers et les assigner a vos guards.
    |
    | Supporte : "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Reinitialisation des mots de passe
    |--------------------------------------------------------------------------
    |
    | Ces options definissent le comportement de la reinitialisation,
    | notamment la table de tokens et le provider utilise.
    |
    | Le delai d'expiration (en minutes) rend les tokens courts pour limiter
    | les risques. Vous pouvez l'ajuster.
    |
    | Le throttle (en secondes) limite la generation de tokens pour eviter
    | les demandes trop frequentes.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Delai de confirmation du mot de passe
    |--------------------------------------------------------------------------
    |
    | Vous pouvez definir le delai avant de redemander le mot de passe.
    | Par defaut, le delai est de trois heures.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
