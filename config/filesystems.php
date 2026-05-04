<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disque par defaut
    |--------------------------------------------------------------------------
    |
    | Vous pouvez definir le disque par defaut. Le disque "local" et
    | plusieurs disques cloud sont disponibles pour le stockage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Disques de stockage
    |--------------------------------------------------------------------------
    |
    | Vous pouvez configurer autant de disques que necessaire, y compris
    | plusieurs disques pour un meme driver. Exemples fournis ci-dessous.
    |
    | Drivers supportes : "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Liens symboliques
    |--------------------------------------------------------------------------
    |
    | Vous pouvez configurer les liens symboliques crees par `storage:link`.
    | Les cles sont les emplacements des liens, les valeurs leurs cibles.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
