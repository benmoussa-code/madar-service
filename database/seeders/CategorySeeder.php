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
        $categories = [
            ['name' => 'Plomberie', 'slug' => 'plomberie', 'icon' => 'wrench'],
            ['name' => 'Électricité', 'slug' => 'electricite', 'icon' => 'bolt'],
            ['name' => 'Peinture', 'slug' => 'peinture', 'icon' => 'paint-brush'],
            ['name' => 'Nettoyage', 'slug' => 'nettoyage', 'icon' => 'broom'],
            ['name' => 'Climatisation', 'slug' => 'climatisation', 'icon' => 'snowflake'],
            ['name' => 'Menuiserie', 'slug' => 'menuiserie', 'icon' => 'hammer'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
