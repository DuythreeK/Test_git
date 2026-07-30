<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = OrderItem::class;
    public function definition()
    {
        $price = $this->faker->numberBetween(100000, 5000000);
        $quantity = $this->faker->numberBetween(1, 5);
        return [
            //
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => $price * $quantity,
        ];
    }
}
