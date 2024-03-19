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
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $product = Product::create([
                'name' => 'Product ' . ($i + 1),
                'price' => rand(10, 100),
                'quantity' => rand(0, 100),
            ]);

            $productId = $product->id;

            $imageFileName = 'product_image_' . $productId . '.jpg';

            $product->image = $imageFileName;
            $product->save();
        }
    }
}
