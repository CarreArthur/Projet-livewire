<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ingredient;

class BurgerDisplay extends Component
{

    public $burger = ['bun_top_brioche', 'bun_bottom_brioche'];
    public $currentBurger = [];
    public $cartCount = 0;
    public $burgerName = '';

    protected $listeners = [
        'ingredientAdd' => 'addToBurger',
        'ingredientRemove' => 'removeFromBurger',
        'resetBurger'   => 'resetBurger',
        'burgerNameUpdated' => 'updateBurgerName',
    ];

    public function mount()
    {
        $this->hydrateCurrentBurger();
        $this->syncCartCount();
    }

    public function updateBurgerName($name)
    {
        $this->burgerName = $name ?? '';
    }

    public function addToBurger($ingredient){
        array_splice($this->burger, 1, 0, $ingredient['slug']);
        $this->hydrateCurrentBurger();
    }

    public function removeFromBurger($ingredient)
    {
        $slug = $ingredient['slug'] ?? null;

        if (! $slug) {
            return;
        }

        $index = array_search($slug, $this->burger, true);

        if ($index !== false) {
            array_splice($this->burger, $index, 1);
        }

        $this->hydrateCurrentBurger();
    }

    public function addCurrentBurgerToCart()
    {
        $this->hydrateCurrentBurger();

        if (empty($this->currentBurger)) {
            return;
        }

        $ingredientsLookup = Ingredient::whereIn('slug', array_unique($this->burger))
            ->get()
            ->keyBy('slug');

        $items = [];
        $totalPrice = 0;

        foreach ($this->burger as $slug) {
            $ingredient = $ingredientsLookup->get($slug);

            if (! $ingredient) {
                continue;
            }

            $items[] = [
                'name' => $ingredient->name,
                'slug' => $ingredient->slug,
                'price' => $ingredient->price,
                'image_path' => $ingredient->image_path,
            ];

            $totalPrice += $ingredient->price;
        }

        $cart = session()->get('cart', []);

        $cart[] = [
            'name' => $this->burgerName ?: 'Burger personnalisé',
            'items' => $items,
            'total_price' => $totalPrice,
            'created_at' => now()->toDateTimeString(),
        ];

        session()->put('cart', $cart);

        $this->syncCartCount();

        session()->flash('success', 'Burger ajouté au panier !');

        $this->resetBurger();
        $this->dispatch('resetBurger');
    }

    public function resetBurger()
    {
        $this->burger = ['bun_top_brioche', 'bun_bottom_brioche'];
        $this->hydrateCurrentBurger();
    }

    public function hydrateCurrentBurger()
    {
        $this->currentBurger = [];

        foreach ($this->burger as $b) {
            $this->currentBurger[] = Ingredient::get()->where('slug', '=', $b)->first();
        }
    }

    public function syncCartCount()
    {
        $cart = session()->get('cart', []);
        $this->cartCount = count($cart);
    }

    public function render()
    {
        return view('livewire.burger-display', [
            'currentBurger' => $this->currentBurger,
        ]);
    }
}
