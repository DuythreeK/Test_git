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
        $products = [
            [
                'name' => 'Nike Air Force 1 Low',
                'description' => 'Giày Nike Air Force 1 Low với thiết kế cổ điển, dễ phối đồ và phù hợp sử dụng hàng ngày.',
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Nike Air Max 270 mang đến cảm giác êm ái với thiết kế đệm khí nổi bật, phù hợp cho các hoạt động hàng ngày.',
            ],
            [
                'name' => 'Nike Air Max 90',
                'description' => 'Nike Air Max 90 sở hữu kiểu dáng thể thao cổ điển, kết hợp giữa sự thoải mái và phong cách năng động.',
            ],
            [
                'name' => 'Nike Air Max 97',
                'description' => 'Nike Air Max 97 nổi bật với thiết kế lấy cảm hứng từ những đường gợn sóng và hệ thống đệm Air đặc trưng.',
            ],
            [
                'name' => 'Nike Air Jordan 1 Low',
                'description' => 'Air Jordan 1 Low mang phong cách bóng rổ cổ điển với thiết kế thấp cổ trẻ trung và dễ phối trang phục.',
            ],
            [
                'name' => 'Nike Air Jordan 1 Mid',
                'description' => 'Air Jordan 1 Mid nổi bật với thiết kế thể thao cá tính, phù hợp với phong cách streetwear.',
            ],
            [
                'name' => 'Nike Dunk Low',
                'description' => 'Nike Dunk Low mang phong cách bóng rổ cổ điển, thiết kế đơn giản và phù hợp với nhiều phong cách thời trang.',
            ],
            [
                'name' => 'Nike Blazer Mid 77',
                'description' => 'Nike Blazer Mid 77 sở hữu thiết kế cổ cao cổ điển, mang lại vẻ ngoài cá tính và mạnh mẽ.',
            ],
            [
                'name' => 'Nike Revolution 7',
                'description' => 'Nike Revolution 7 là mẫu giày thể thao nhẹ, thoải mái và phù hợp cho chạy bộ hoặc sử dụng hàng ngày.',
            ],
            [
                'name' => 'Nike Pegasus 41',
                'description' => 'Nike Pegasus 41 được thiết kế dành cho chạy bộ với khả năng hỗ trợ tốt và cảm giác thoải mái khi vận động.',
            ],

            [
                'name' => 'Adidas Superstar',
                'description' => 'Adidas Superstar sở hữu thiết kế cổ điển với phần mũi giày đặc trưng, dễ phối với nhiều trang phục.',
            ],
            [
                'name' => 'Adidas Stan Smith',
                'description' => 'Adidas Stan Smith mang phong cách tối giản, thanh lịch và phù hợp sử dụng trong nhiều hoàn cảnh.',
            ],
            [
                'name' => 'Adidas Ultraboost Light',
                'description' => 'Adidas Ultraboost Light mang lại cảm giác êm ái và hỗ trợ tốt cho các hoạt động chạy bộ.',
            ],
            [
                'name' => 'Adidas Forum Low',
                'description' => 'Adidas Forum Low kết hợp phong cách bóng rổ cổ điển với thiết kế hiện đại, trẻ trung.',
            ],
            [
                'name' => 'Adidas Gazelle',
                'description' => 'Adidas Gazelle nổi bật với thiết kế thấp cổ cổ điển và phong cách thời trang đơn giản.',
            ],
            [
                'name' => 'Adidas Samba OG',
                'description' => 'Adidas Samba OG mang phong cách retro đặc trưng, phù hợp với thời trang đường phố và casual.',
            ],
            [
                'name' => 'Adidas Campus 00s',
                'description' => 'Adidas Campus 00s sở hữu kiểu dáng chunky trẻ trung, phù hợp với phong cách streetwear hiện đại.',
            ],
            [
                'name' => 'Adidas Adilette Comfort',
                'description' => 'Adidas Adilette Comfort là mẫu dép thể thao đơn giản, nhẹ và phù hợp sử dụng hàng ngày.',
            ],
            [
                'name' => 'Adidas Duramo SL',
                'description' => 'Adidas Duramo SL là mẫu giày chạy bộ nhẹ với thiết kế năng động và thoải mái.',
            ],
            [
                'name' => 'Adidas Runfalcon 5',
                'description' => 'Adidas Runfalcon 5 phù hợp cho chạy bộ và tập luyện với thiết kế thể thao nhẹ nhàng.',
            ],

            [
                'name' => 'Puma Suede Classic',
                'description' => 'Puma Suede Classic mang phong cách cổ điển với chất liệu mềm mại và thiết kế dễ phối đồ.',
            ],
            [
                'name' => 'Puma RS-X',
                'description' => 'Puma RS-X sở hữu thiết kế mạnh mẽ, nhiều lớp chi tiết và phù hợp với phong cách streetwear.',
            ],
            [
                'name' => 'Puma Future Rider',
                'description' => 'Puma Future Rider kết hợp phong cách retro với thiết kế hiện đại, phù hợp sử dụng hàng ngày.',
            ],
            [
                'name' => 'Puma Cali Dream',
                'description' => 'Puma Cali Dream mang phong cách thời trang trẻ trung với thiết kế đế cao và kiểu dáng hiện đại.',
            ],
            [
                'name' => 'Puma Smash v2',
                'description' => 'Puma Smash v2 sở hữu thiết kế đơn giản, thanh lịch và dễ dàng kết hợp với trang phục casual.',
            ],
            [
                'name' => 'Puma Caven 2.0',
                'description' => 'Puma Caven 2.0 lấy cảm hứng từ phong cách bóng rổ cổ điển với kiểu dáng trẻ trung.',
            ],
            [
                'name' => 'Puma Flyer Runner',
                'description' => 'Puma Flyer Runner là mẫu giày thể thao nhẹ, phù hợp chạy bộ và tập luyện hàng ngày.',
            ],
            [
                'name' => 'Puma Softride Enzo',
                'description' => 'Puma Softride Enzo mang lại cảm giác êm ái và hỗ trợ tốt cho các hoạt động vận động.',
            ],
            [
                'name' => 'Puma Anzarun Lite',
                'description' => 'Puma Anzarun Lite có thiết kế nhẹ nhàng, hiện đại và phù hợp cho sử dụng hàng ngày.',
            ],
            [
                'name' => 'Puma BMW Motorsport',
                'description' => 'Puma BMW Motorsport kết hợp phong cách thể thao với cảm hứng từ dòng xe đua BMW Motorsport.',
            ],

            [
                'name' => 'Converse Chuck Taylor All Star',
                'description' => 'Converse Chuck Taylor All Star là mẫu giày kinh điển với thiết kế trẻ trung và dễ phối đồ.',
            ],
            [
                'name' => 'Converse Chuck 70',
                'description' => 'Converse Chuck 70 giữ phong cách cổ điển đặc trưng với chất liệu và hoàn thiện cao cấp hơn.',
            ],
            [
                'name' => 'Converse Run Star Hike',
                'description' => 'Converse Run Star Hike nổi bật với phần đế cao mạnh mẽ, mang đến phong cách cá tính.',
            ],
            [
                'name' => 'Converse Run Star Motion',
                'description' => 'Converse Run Star Motion sở hữu thiết kế hiện đại với phần đế nổi bật và phong cách thời trang.',
            ],
            [
                'name' => 'Converse One Star',
                'description' => 'Converse One Star mang phong cách skate cổ điển với biểu tượng ngôi sao đặc trưng.',
            ],
            [
                'name' => 'Converse Jack Purcell',
                'description' => 'Converse Jack Purcell sở hữu thiết kế tối giản, thanh lịch và phù hợp với phong cách casual.',
            ],
            [
                'name' => 'Converse Weapon',
                'description' => 'Converse Weapon mang phong cách bóng rổ cổ điển với thiết kế mạnh mẽ và cá tính.',
            ],
            [
                'name' => 'Converse Pro Leather',
                'description' => 'Converse Pro Leather kết hợp kiểu dáng thể thao cổ điển với phong cách thời trang hiện đại.',
            ],
            [
                'name' => 'Converse All Star Move',
                'description' => 'Converse All Star Move mang thiết kế trẻ trung với phần đế cao, phù hợp với phong cách thời trang nữ.',
            ],
            [
                'name' => 'Converse Run Star Legacy',
                'description' => 'Converse Run Star Legacy kết hợp phong cách cổ điển với những đường nét hiện đại và cá tính.',
            ],

            [
                'name' => 'Vans Old Skool',
                'description' => 'Vans Old Skool mang phong cách skate đặc trưng với thiết kế trẻ trung và dễ phối đồ.',
            ],
            [
                'name' => 'Vans Authentic',
                'description' => 'Vans Authentic sở hữu thiết kế đơn giản, nhẹ và phù hợp với phong cách casual hàng ngày.',
            ],
            [
                'name' => 'Vans Era',
                'description' => 'Vans Era là mẫu giày skate cổ điển với thiết kế đơn giản và phần đệm cổ chân thoải mái.',
            ],
            [
                'name' => 'Vans Sk8-Hi',
                'description' => 'Vans Sk8-Hi nổi bật với thiết kế cổ cao và phong cách skate đặc trưng của Vans.',
            ],
            [
                'name' => 'Vans Slip-On',
                'description' => 'Vans Slip-On mang thiết kế không dây tiện lợi, dễ mang và phù hợp với phong cách casual.',
            ],
            [
                'name' => 'Vans Knu Skool',
                'description' => 'Vans Knu Skool lấy cảm hứng từ phong cách skate thập niên 90 với phần thân giày dày và nổi bật.',
            ],
            [
                'name' => 'Vans Ultrarange',
                'description' => 'Vans Ultrarange kết hợp phong cách năng động với thiết kế nhẹ và phù hợp cho các hoạt động hàng ngày.',
            ],
            [
                'name' => 'Vans Filmore Hi',
                'description' => 'Vans Filmore Hi sở hữu kiểu dáng cổ cao trẻ trung, phù hợp với phong cách streetwear.',
            ],
            [
                'name' => 'Vans Ward',
                'description' => 'Vans Ward mang kiểu dáng skate cổ điển, đơn giản và dễ phối với nhiều loại trang phục.',
            ],
            [
                'name' => 'Vans Atwood',
                'description' => 'Vans Atwood có thiết kế thể thao đơn giản, phù hợp sử dụng hàng ngày và đi học.',
            ],
        ];

        $product = $this->faker->randomElement($products);
        return [
            //
            "category_id" => Category::inRandomOrder()->first()->id,
            "name" => $product['name'],
            "description" => $product['description'],
            "price" => $this->faker->randomElement(
                [
                    799000,
                    899000,
                    999000,
                    1199000,
                    1299000,
                    1499000,
                    1699000,
                    1999000,
                    2299000,
                    2499000,
                ]
            ),

            "image" => "products/default.png",
            "status" => true,
        ];
    }
}
