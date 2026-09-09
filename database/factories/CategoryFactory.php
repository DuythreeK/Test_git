<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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

        return $this->faker()->randomElement($categories);
    }
    // return [
    //     'name' => $this->faker->unique()->word(),
    //     'description' => $this->faker->sentence(),
    // ];
}
