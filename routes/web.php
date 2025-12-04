<?php

use App\Livewire\Home;
use App\Livewire\Builder;
use Illuminate\Support\Facades\Route;

// La page d'accueil devient la "Home"
Route::get('/', Home::class)->name('home');


