<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dogCat = \App\Models\Category::where('name', 'Dogs')->first();
        $catCat = \App\Models\Category::where('name', 'Cats')->first();
        $birdCat = \App\Models\Category::where('name', 'Birds')->first();
        $smallCat = \App\Models\Category::where('name', 'Small Pets')->first();

        \App\Models\Product::create([
            'category_id' => $dogCat->id,
            'name' => 'Premium Kibble',
            'description' => 'High-quality nutritious kibble for all dog breeds. Packed with protein and vitamins.',
            'price' => 45.99,
            'stock' => 50,
            'image_url' => 'dog_food.png'
        ]);

        \App\Models\Product::create([
            'category_id' => $catCat->id,
            'name' => 'Luxury Cat Tree',
            'description' => 'A multi-level cat tree with scratching posts and a cozy hammock.',
            'price' => 89.99,
            'stock' => 15,
            'image_url' => 'cat_tree.png'
        ]);

        \App\Models\Product::create([
            'category_id' => $birdCat->id,
            'name' => 'Golden Bird Cage',
            'description' => 'Elegant and spacious cage suitable for parrots and canaries.',
            'price' => 120.00,
            'stock' => 5,
            'image_url' => 'bird_cage.png'
        ]);

        \App\Models\Product::create([
            'category_id' => $smallCat->id,
            'name' => 'Silent Hamster Wheel',
            'description' => 'Noise-free exercise wheel for hamsters and gerbils.',
            'price' => 12.50,
            'stock' => 100,
            'image_url' => 'hamster_wheel.png'
        ]);
    }
}
