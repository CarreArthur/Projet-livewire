<?php
namespace App\Livewire;

use App\Models\Ingredient;


use Livewire\Component;

class BurgerBuilder extends Component
{

    public function addToBurger($id)
    {
        dd(Ingredient::find($id));
    }


    public function render()
    {
        $ingredients = Ingredient::query()->get();
        return view('livewire.burger-builder', compact('ingredients'));
    }
}
