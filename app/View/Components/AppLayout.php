<?php

// composant layout app
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
        * Recupere la vue / le contenu du composant.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
