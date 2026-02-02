<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Dogs']);
        \App\Models\Category::create(['name' => 'Cats']);
        \App\Models\Category::create(['name' => 'Birds']);
        \App\Models\Category::create(['name' => 'Small Pets']);
    }
}
