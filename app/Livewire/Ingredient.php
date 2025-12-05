<?php

namespace App\Livewire;

use Livewire\Component;

class Ingredient extends Component
{
   
    public $ingredient;
    public function mount($ingredient) {
        $this->ingredient = $ingredient;
    }

    public function render()
    {
        return view('livewire.ingredient', );
    }

    //public function addBurger()
    //{
    //    $this->dispatch('ingredientAdd', ingredient:$this->ingredient);
    //}

}
