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
use App\Models\ProductVariant;

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
        $categories = [
            [
                'name' => 'Sneaker',
                'description' => 'Các mẫu giày sneaker phù hợp với nhiều phong cách thời trang.',
            ],
            [
                'name' => 'Running',
                'description' => 'Các mẫu giày chuyên dụng cho chạy bộ và luyện tập thể thao.',
            ],
            [
                'name' => 'Basketball',
                'description' => 'Các mẫu giày bóng rổ hỗ trợ vận động và thi đấu.',
            ],
            [
                'name' => 'Football',
                'description' => 'Các mẫu giày dành cho bóng đá.',
            ],
            [
                'name' => 'Casual',
                'description' => 'Các mẫu giày thời trang sử dụng hàng ngày.',
            ],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
        $categoryModels = Category::all();
        //SIZE
        $this->call(SizeSeeder::class);
        //PRODUCT
        $products = Product::factory(100)->make()
        ->each(function ($product) use ($categoryModels) {
            $product->category_id = $categoryModels->random()->id;
            $product->save();
        });

        //PRODUCT_VARIANT
        $this->call(ProductVariantSeeder::class);
        $variants = ProductVariant::all();

        //USER
        $users = User::factory(10)->create();

        $users->each(function ($user) use ($variants) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
            $cartVariants = $variants->random(rand(1, 5));
            foreach ($cartVariants as $variant) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant -> id,
                    'quantity' => rand(1, 3),
                ]);
            }

        });

        //ORDER
        $users->each(function ($user) use ($variants, $products) {

            $orders = Order::factory(rand(2, 5))-> make();

            foreach ($orders as $order) {
                $order->user_id = $user->id;
                $order->save();

                $total = 0;
                $orderVariants = $variants->random(rand(1, 5));
                foreach ($orderVariants as $variant) {
                    $product = $products->where('id', $variant->product_id)->first();
                    $quantity = rand(1, 3);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
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
