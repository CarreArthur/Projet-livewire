<?php

namespace App\Livewire;

use Livewire\Component;

class Ingredient extends Component
{
    public $lien = "";
    public $price = 0;

    public function render()
    {
        return view('livewire.ingredient', [
            'lien' => $this->lien,
        ]);
    }

}
