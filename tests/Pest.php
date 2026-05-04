<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
 | Cas de test
|--------------------------------------------------------------------------
|
 | La closure fournie aux tests est liee a une classe PHPUnit specifique.
 | Par defaut, c'est "PHPUnit\Framework\TestCase". Vous pouvez la changer
 | via "pest()" pour lier une autre classe ou des traits.
|
*/

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
 | Attentes
|--------------------------------------------------------------------------
|
 | En ecrivant des tests, vous devez verifier des conditions. La fonction
 | "expect()" donne acces a des methodes d'attentes. Vous pouvez etendre
 | cette API a tout moment.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
 | Fonctions
|--------------------------------------------------------------------------
|
 | Pest est puissant, mais vous pouvez avoir du code specifique a ne pas
 | repeter. Ici, vous pouvez exposer des helpers globaux pour reduire
 | le code dans les fichiers de test.
|
*/

function something()
{
    // ...
}
