<?php

use App\Livewire\Home;
use App\Livewire\Builder;
use App\Livewire\Cart;
use Illuminate\Support\Facades\Route;

// La page d'accueil devient la "Home"
Route::get('/', Home::class)->name('home');

Route::get("/builder", App\Livewire\BurgerDisplay::class)->name('BurgerDisplay');
Route::get('/panier', Cart::class)->name('cart');


