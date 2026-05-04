<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nom de l'application
    |--------------------------------------------------------------------------
    |
    | Cette valeur est le nom de votre application, utilise lorsque le
    | framework doit afficher le nom dans une notification ou d'autres
    | elements d'interface.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Environnement de l'application
    |--------------------------------------------------------------------------
    |
    | Cette valeur determine l'environnement d'execution. Elle peut
    | influencer la configuration des services utilises. A definir
    | dans le fichier .env.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Mode debug de l'application
    |--------------------------------------------------------------------------
    |
    | En mode debug, des erreurs detaillees avec trace sont affichees.
    | Si desactive, une page d'erreur generique est affichee.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL de l'application
    |--------------------------------------------------------------------------
    |
    | Cette URL est utilisee par la console pour generer des URLs via
    | Artisan. A definir sur la racine de l'application.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuseau horaire de l'application
    |--------------------------------------------------------------------------
    |
    | Vous pouvez definir le fuseau horaire par defaut, utilise par les
    | fonctions PHP de date. Par defaut, "UTC" convient a la plupart des cas.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Configuration de la langue
    |--------------------------------------------------------------------------
    |
    | La langue par defaut est utilisee par les methodes de traduction.
    | Vous pouvez la definir pour toute langue supportee.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Cle de chiffrement
    |--------------------------------------------------------------------------
    |
    | Cette cle est utilisee pour le chiffrement. Elle doit etre aleatoire
    | et faire 32 caracteres pour garantir la securite. A definir avant
    | le deploiement.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilote du mode maintenance
    |--------------------------------------------------------------------------
    |
    | Ces options determinent le pilote qui gere le mode maintenance.
    | Le pilote "cache" permet de piloter le mode sur plusieurs machines.
    |
    | Pilotes supportes : "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
