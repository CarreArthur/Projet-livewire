<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        // On vide la table avant de remplir pour éviter les doublons
        DB::table('ingredients')->truncate();

        $ingredients = [
            // --- BUNS (Pains) ---
            [
                'name' => 'Bun Brioché (Haut)',
                'slug' => 'bun_top_brioche',
                'category' => 'bun_top',
                'price' => 50,
                'image_path' => 'ingredients/bun-top.png',
            ],
            
            // --- MEAT (Viandes) ---
            [
                'name' => 'Steak de Bœuf (150g)',
                'slug' => 'beef_patty',
                'category' => 'meat',
                'price' => 250, // 2.50€
                'image_path' => 'ingredients/beef.png',
            ],
            [
                'name' => 'Filet de Poulet Pané',
                'slug' => 'chicken_fried',
                'category' => 'meat',
                'price' => 300,
                'image_path' => 'ingredients/chicken.png',
            ],

            // --- CHEESE (Fromages) ---
            [
                'name' => 'Cheddar Fondu',
                'slug' => 'cheddar',
                'category' => 'cheese',
                'price' => 100,
                'image_path' => 'ingredients/cheddar.png',
            ],
            [
                'name' => 'Fromage à Raclette',
                'slug' => 'raclette',
                'category' => 'cheese',
                'price' => 150,
                'image_path' => 'ingredients/raclette.png',
            ],

            // --- VEGGIES (Légumes) ---
            [
                'name' => 'Feuille de Salade',
                'slug' => 'lettuce',
                'category' => 'veggie',
                'price' => 20, // 0.20€
              'image_path' => 'ingredients/lettuce.png',
            ],
            [
                'name' => 'Rondelles de Tomate',
                'slug' => 'tomato',
                'category' => 'veggie',
                'price' => 30,
               'image_path' => 'ingredients/tomato.png',
            ],
            [
                'name' => 'Oignons Rouges',
                'slug' => 'red_onion',
                'category' => 'veggie',
                'price' => 20,
               'image_path' => 'ingredients/onion.png',
            ],
            [
                'name' => 'Cornichons (Pickles)',
                'slug' => 'pickles',
                'category' => 'veggie',
                'price' => 20,
              'image_path' => 'ingredients/pickles.png',
            ],
            [
                'name' => 'Jalapeno',
                'slug' => 'jalapeno',
                'category' => 'veggie',
                'price' => 50,
               'image_path' => 'ingredients/jalapeno.png',
            ],

            // --- SAUCES ---
            [
                'name' => 'Ketchup Maison',
                'slug' => 'ketchup',
                'category' => 'sauce',
                'price' => 50,
               'image_path' => 'ingredients/sauce-ketchup.png',
            ],
            [
                'name' => 'Mayonnaise',
                'slug' => 'mayo',
                'category' => 'sauce',
                'price' => 50,
               'image_path' => 'ingredients/sauce-mayo.png',
            ],
            [
                'name' => 'Bun Brioché (Bas)',
                'slug' => 'bun_bottom_brioche',
                'category' => 'bun_bottom',
                'price' => 50, // 0.50€
                'image_path' => 'ingredients/bun-bottom.png',
            ]
        ];

        // Insertion
        DB::table('ingredients')->insert($ingredients);
    }
}