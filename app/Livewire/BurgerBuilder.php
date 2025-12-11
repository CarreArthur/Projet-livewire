<?php

namespace App\Livewire;

use App\Models\Ingredient;
use Livewire\Component;

class BurgerBuilder extends Component
{
    public $ingredients;
    public $quantities = [];
    public $total = 0;

    protected $listeners = [
        'resetBurger' => 'handleResetBurger',
    ];

    public function mount()
    {
        // On inclut tous les ingrédients dans la liste, mais le pain du haut
        // et le pain du bas sont affichés comme déjà inclus et non modifiables.
        $this->ingredients = Ingredient::all();

        foreach ($this->ingredients as $ingredient) {
            if (in_array($ingredient->slug, ['bun_top_brioche', 'bun_bottom_brioche'])) {
                $this->quantities[$ingredient->id] = 1;
            } else {
                $this->quantities[$ingredient->id] = 0;
            }
        }
    }

    public function getFormattedTotalProperty()
    {
        return number_format($this->total / 100, 2);
    }

    public function increment($ingredientId)
    {
        if (! isset($this->quantities[$ingredientId])) {
            return;
        }

        $ingredient = $this->ingredients->firstWhere('id', $ingredientId);

        // On ne permet pas de modifier la quantité des pains (déjà inclus).
        if ($ingredient && in_array($ingredient->slug, ['bun_top_brioche', 'bun_bottom_brioche'])) {
            return;
        }

        $this->quantities[$ingredientId]++;

        if ($ingredient) {
            $this->total += $ingredient->price;

            $this->dispatch('ingredientAdd', ingredient: $ingredient->toArray());
        }
    }

    public function decrement($ingredientId)
    {
        if (! isset($this->quantities[$ingredientId]) || $this->quantities[$ingredientId] <= 0) {
            return;
        }
        $ingredient = $this->ingredients->firstWhere('id', $ingredientId);

        // On ne permet pas de modifier la quantité des pains (déjà inclus).
        if ($ingredient && in_array($ingredient->slug, ['bun_top_brioche', 'bun_bottom_brioche'])) {
            return;
        }

        $this->quantities[$ingredientId]--;

        if ($ingredient) {
            $this->total -= $ingredient->price;

            $this->dispatch('ingredientRemove', ingredient: $ingredient->toArray());
        }
    }

    public function resetBuilder()
    {
        $this->handleResetBurger();
        $this->dispatch('resetBurger');
    }

    public function handleResetBurger()
    {
        foreach ($this->quantities as $id => $quantity) {
            $ingredient = $this->ingredients->firstWhere('id', $id);

            if ($ingredient && in_array($ingredient->slug, ['bun_top_brioche', 'bun_bottom_brioche'])) {
                $this->quantities[$id] = 1;
            } else {
                $this->quantities[$id] = 0;
            }
        }

        $this->total = 0;
    }

    public function render()
    {
        return view('livewire.burger-builder', [
            'ingredients' => $this->ingredients,
        ]);
    }
}
