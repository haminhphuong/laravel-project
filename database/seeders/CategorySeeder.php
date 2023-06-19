<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Men Shoes',
                'slug' => 'men-shoes',
            ],
            [
                'name' => 'Women Shoes',
                'slug' => 'women-shoes',
            ],
            [
                'name' => 'Kid Shoes',
                'slug' => 'kid-shoes',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

