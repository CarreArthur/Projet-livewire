<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ingredient;

class BurgerDisplay extends Component
{

    public $burger = ['bun_top_brioche', 'bun_bottom_brioche'];
    public $currentBurger = [];

    protected $listeners = ['ingredientAdd'=>'addToBurger'];

    public function addToBurger($ingredient){
        $this->currentBurger = [];
        array_splice($this->burger, 1, 0, $ingredient['slug']);

        foreach($this->burger as $b){
            $this->currentBurger[] = Ingredient::get()->where('slug', '=', $b)->first();
        }
        //dd($this->currentBurger);
    }

    public function render()
    {
        return view('livewire.burger-display', $this->currentBurger);
    }
}
