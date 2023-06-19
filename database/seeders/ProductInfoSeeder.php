<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductInfo;

class ProductInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productInfos = [
            [
                'product_id' => 1,
                'specifications' => 'Color: Black',
                'features' => 'Durable and stylish design',
            ],
            [
                'product_id' => 2,
                'specifications' => 'Size: 8-10',
                'features' => 'Comfortable and lightweight',
            ],
            [
                'product_id' => 3,
                'specifications' => 'Weight: 100g',
                'features' => 'Breathable and flexible',
            ]
        ];

        foreach ($productInfos as $productInfo) {
            ProductInfo::create($productInfo);
        }
    }
}

