<?php

use App\Livewire\Home;
use App\Livewire\Builder;
use Illuminate\Support\Facades\Route;

// La page d'accueil devient la "Home"
Route::get('/', Home::class)->name('home');

Route::get("/builder", App\Livewire\BurgerBuilder::class)->name('BurgerBuilder');


