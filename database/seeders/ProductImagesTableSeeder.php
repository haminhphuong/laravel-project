<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImages = [
            [
                'product_id' => 1,
                'image' => 'p1.jpg',
            ],
            [
                'product_id' => 1,
                'image' => 'p1.jpg',
            ],
            [
                'product_id' => 2,
                'image' => 'p2.jpg',
            ],
            [
                'product_id' => 2,
                'image' => 'p2.jpg',
            ],
            [
                'product_id' => 3,
                'image' => 'p3.jpg',
            ],
        ];

        foreach ($productImages as $productImage) {
            ProductImage::create($productImage);
        }
    }
}
