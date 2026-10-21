<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $products = Product::with('variants')->get();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('Cần có ít nhất 1 User và 1 Product để tạo đánh giá.');
            return;
        }

        // Danh sách mẫu bình luận thực tế theo mức sao
        $sampleComments = [
            5 => [
                'Giày đi cực êm chân, form dáng chuẩn mẫu, rất hài lòng!',
                'Chất lượng xuất sắc, đóng gói cẩn thận, shipper thân thiện 10/10.',
                'Đẹp hơn cả trong ảnh, mang đi học đi chơi đều hợp.',
                'Hàng chính hãng chuẩn xịn, đế giày bám tốt, sẽ ủng hộ shop tiếp.',
                'Màu sắc chuẩn, đi nhẹ tênh, rất đáng tiền!',
            ],
            4 => [
                'Giày đẹp, giao hàng hơi lâu một chút nhưng bù lại chất lượng rất ổn.',
                'Đi vừa vặn, đế hơi cứng một xíu lúc đầu nhưng đi vài hôm là êm.',
                'Sản phẩm tốt trong tầm giá, đóng gói hộp hơi móp nhẹ nhưng giày bên trong nguyên vẹn.',
                'Mẫu mã thời trang, phối đồ rất dễ.',
            ],
            3 => [
                'Chất lượng tạm ổn so với giá tiền, form giày hơi rộng hơn bình thường một chút.',
                'Giao đúng mẫu nhưng thời gian vận chuyển chậm.',
                'Đi được nhưng phần lót giày chưa được êm lắm.',
            ],
        ];

        foreach ($products as $product) {
            // Lấy các biến thể (variants) của sản phẩm
            $variants = $product->variants;
            if ($variants->isEmpty()) {
                continue;
            }

            // Tạo ngẫu nhiên từ 2 đến 5 đánh giá cho mỗi sản phẩm
            $reviewCount = rand(2, 5);
            $randomUsers = $users->random(min($reviewCount, $users->count()));

            foreach ($randomUsers as $user) {
                $variant = $variants->random();

                // 1. Tạo một đơn hàng "completed" cho user này
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_date' => Carbon::now()->subDays(rand(1, 30)),
                    'status' => 'completed',
                    'total_price' => $product->price,
                    'shipping_address' => 'Địa chỉ giao hàng mẫu',
                    'receiver_name' => $user->name,
                    'phone' => '09' . rand(10000000, 99999999),
                    'note' => 'Đơn hàng mẫu tạo seeder',
                ]);

                // 2. Tạo OrderItem tương ứng với variant của sản phẩm
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => 1,
                    'price' => $product->price,
                    'subtotal' => $product->price,
                ]);

                // 3. Tỷ lệ số sao (đa số 4-5 sao để sản phẩm đẹp)
                $rating = rand(1, 100) <= 70 ? 5 : (rand(1, 100) <= 80 ? 4 : 3);
                $comments = $sampleComments[$rating];
                $commentText = $comments[array_rand($comments)];

                // 4. Tạo Review
                Review::create([
                    'user_id' => $user->id,
                    'order_item_id' => $orderItem->id,
                    'rating' => $rating,
                    'comment' => $commentText,
                    'created_at' => Carbon::now()->subDays(rand(0, 15))->subHours(rand(1, 23)),
                ]);
            }
        }

        $this->command->info('Đã tạo thành công dữ liệu đánh giá cho toàn bộ sản phẩm!');
    }
}
