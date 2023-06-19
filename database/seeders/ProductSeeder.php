<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Men Sneakers',
                'description' => 'High-quality sneakers for men',
                'price' => 100.00,
                'quantity' => 10,
                'is_featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Women Sandals',
                'description' => 'Stylish sandals for women',
                'price' => 50.00,
                'quantity' => 20,
                'is_featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Kid Running Shoes',
                'description' => 'Comfortable running shoes for kids',
                'price' => 70.00,
                'quantity' => 5,
                'is_featured' => false,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

