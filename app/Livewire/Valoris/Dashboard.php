<?php

namespace App\Livewire\Valoris;

use Livewire\Component;

class Dashboard extends Component
{
    // Propriétés publiques peuvent être ajoutées ici
    // Ex: public $tasks;

    public function render()
    {
        // Retourne la vue associée au composant
        return view('livewire.valoris.dashboard');
    }
}
