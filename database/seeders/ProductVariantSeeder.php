<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\Size;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $sizes = Size::all();

        foreach ($products as $product) {
            $randomSizes = $sizes->random(4);
            foreach ($randomSizes as $size) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size_id' => $size->id,
                    'stock' => rand(10, 200),
                ]);
            }
        }
    }
}
