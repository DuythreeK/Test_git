<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;

// use Illuminate\Support\Facades\DB
// use Illuminate\Database\Userseeder
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(Userseeder::class);

        //CATEGORY
        $categries = Category::factory(5)->create();

        //PRODUCT
        $products = Product::factory(100)->make()
        ->each(function ($product) use ($categries) {
            $product->category_id = $categries->random()->id;
            $product->save();
        });

        //USER
        $users = User::factory(10)->create();

        $users->each(function ($user) use ($products) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
            $cartProducts = $products->random(rand(1, 5));
            foreach ($cartProducts as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                ]);
            }

        });

        //ORDER
        $users->each(function ($user) use ($products) {

            $orders = Order::factory(rand(2, 5))-> make();

            foreach ($orders as $order) {
                $order->user_id = $user->id;
                $order->save();
                $total = 0;
                for ($i = 0; $i < rand(1, 5); $i++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'subtotal' => $product->price * $quantity,
                    ]);
                    $total += $product->price * $quantity;
                }
                $order->update(['total_price' => $total]);
            }
        });
    }
}
