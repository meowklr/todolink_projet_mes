<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de session par defaut
    |--------------------------------------------------------------------------
    |
    | Cette option definit le driver de session par defaut. Laravel supporte
    | plusieurs stockages. La base de donnees est un bon choix par defaut.
    |
    | Supportes : "file", "cookie", "database", "memcached",
    |             "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Duree de vie de la session
    |--------------------------------------------------------------------------
    |
    | Indique le nombre de minutes d'inactivite avant expiration. Pour
    | expirer a la fermeture du navigateur, utilisez expire_on_close.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Chiffrement des sessions
    |--------------------------------------------------------------------------
    |
    | Permet de chiffrer les donnees de session avant stockage.
    | Le chiffrement est gere par Laravel de maniere transparente.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Emplacement des fichiers de session
    |--------------------------------------------------------------------------
    |
    | Avec le driver "file", les sessions sont sur disque. Vous pouvez
    | choisir un autre emplacement si besoin.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Connexion base de donnees pour les sessions
    |--------------------------------------------------------------------------
    |
    | Avec les drivers "database" ou "redis", vous pouvez choisir la
    | connexion a utiliser. Elle doit exister dans config/database.php.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Table des sessions
    |--------------------------------------------------------------------------
    |
    | Avec le driver "database", vous pouvez definir la table utilisee.
    | Un nom par defaut est fourni mais peut etre change.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Store de cache pour les sessions
    |--------------------------------------------------------------------------
    |
    | Avec un backend base sur le cache, vous pouvez definir le store a
    | utiliser. Il doit exister dans la config cache.
    |
    | Concerne : "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Loterie de nettoyage des sessions
    |--------------------------------------------------------------------------
    |
    | Certains drivers nettoient les anciennes sessions via une loterie.
    | Par defaut : 2 chances sur 100 a chaque requete.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nom du cookie de session
    |--------------------------------------------------------------------------
    |
    | Vous pouvez changer le nom du cookie de session. En general, ce n'est
    | pas necessaire et n'apporte pas de gain de securite.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Chemin du cookie de session
    |--------------------------------------------------------------------------
    |
    | Le chemin indique ou le cookie est disponible. Par defaut, la racine
    | de l'application.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Domaine du cookie de session
    |--------------------------------------------------------------------------
    |
    | Definit le domaine et sous-domaines du cookie. Par defaut, le domaine
    | racine sans sous-domaines.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookies uniquement HTTPS
    |--------------------------------------------------------------------------
    |
    | Si true, les cookies ne sont envoyes qu'en HTTPS. Cela evite les envois
    | non securises.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Acces HTTP uniquement
    |--------------------------------------------------------------------------
    |
    | Si true, JavaScript ne peut pas lire le cookie. Il n'est accessible
    | qu'en HTTP. Il est conseille de le laisser actif.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Cookies SameSite
    |--------------------------------------------------------------------------
    |
    | Definit le comportement en requetes cross-site, utile contre le CSRF.
    | Par defaut, "lax" pour autoriser les requetes securisees.
    |
    | Voir : https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Supportes : "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Cookies partitionnes
    |--------------------------------------------------------------------------
    |
    | Si true, le cookie est lie au site de premier niveau en contexte cross-site.
    | Les cookies partitionnes sont acceptes si "secure" et SameSite="none".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | Serialisation des sessions
    |--------------------------------------------------------------------------
    |
    | Definit la strategie de serialisation. Par defaut, JSON. Le mode "php"
    | permet de stocker des objets, mais peut exposer a des attaques si APP_KEY fuit.
    |
    | Supportes : "json", "php"
    |
    */

    'serialization' => 'json',

];
