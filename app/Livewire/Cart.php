<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = session()->get('cart', []);
    }

    public function checkout()
    {
        if (empty($this->items)) {
            session()->flash('error', 'Votre panier est vide.');
            return;
        }

        session()->forget('cart');
        $this->items = [];

        session()->flash('success', 'Merci ! Votre commande est validée.');
    }

    public function removeItem($index)
    {
        if (! isset($this->items[$index])) {
            return;
        }

        unset($this->items[$index]);

        $this->items = array_values($this->items);
        session()->put('cart', $this->items);
    }

    public function getTotalProperty()
    {
        return collect($this->items)->sum('total_price');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
