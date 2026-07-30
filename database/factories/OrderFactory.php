<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => User::factory(),
            'order_date'=> now(),
            'status'=> $this->faker->randomElement(['pending', 'processing', 'shipping', 'completed']),
            'total_price'=> 0,
            'shipping_address'=> $this->faker->address(),
            'note'=> $this->faker->sentence(),
        ];
    }
}
