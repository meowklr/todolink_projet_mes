<?php

// composant layout guest
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
        * Recupere la vue / le contenu du composant.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
