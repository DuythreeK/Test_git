<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;

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
        $variant = ProductVariant::inRandomOrder()->first();
        $price = $variant->product->price;
        $quantity = $this->faker->numberBetween(1, 5);
        return [
            //
            'order_id' => Order::inRandomOrder()->first()->id,
            'product_variant_id' => $variant->id,
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => $price * $quantity,
        ];
    }
}
