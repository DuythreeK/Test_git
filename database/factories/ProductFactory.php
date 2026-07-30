<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "category_id" => Category::factory(),
            "name" => $this->faker->word(),
            "description" => $this->faker->paragraph(),
            "price" => $this->faker->numberBetween(100000, 5000000),
            "stock" => $this->faker->numberBetween(10, 200),
            "image" => "products/default.png",
            "status" => true,
        ];
    }
}
