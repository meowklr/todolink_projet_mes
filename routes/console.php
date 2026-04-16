<?php

// routes console
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// commande inspire
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
