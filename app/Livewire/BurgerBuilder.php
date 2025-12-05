<?php
namespace App\Livewire;

use App\Models\Ingredient;


use Livewire\Component;

class BurgerBuilder extends Component
{




    public function render()
    {
        $ingredients = Ingredient::all();
        return view('livewire.burger-builder', compact('ingredients'));
    }
}
