<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
        $this->model = config('services.gemini.model', 'gemini-1.5-flash');
    }

    public function generateReply(string $message): string
    {
        if (empty($this->apiKey)) {
            return $this->fallbackReply($message);
        }

        $prompt = $this->buildShoePrompt($message);

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::timeout(15)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 700,
                ]
            ]);

            if ($response->successful()) {
                $reply = $response->json('candidates.0.content.parts.0.text');
                if (!empty($reply)) {
                    return trim($reply);
                }
            }
            return $this->fallbackReply($message);
        } catch (\Exception $e) {
            return $this->fallbackReply($message);
        }
    }


    protected function buildShoePrompt(string $message): string
    {

        $categories = Category::pluck('name')->implode(', ');

        $shoes = Product::with(['category', 'variants.size'])
            ->where('status', 1)
            ->latest()
            // ->take(25)
            ->get()
            ->map(function ($shoe) {
                $catName = $shoe->category ? $shoe->category->name : 'Sneaker';
                $price = number_format($shoe->price) . ' VNĐ';

                $sizesInStock = $shoe->variants
                    ->filter(fn($v) => $v->stock > 0)
                    ->map(fn($v) => "Size " . ($v->size->name ?? '?') . " (còn {$v->stock})")
                    ->implode(', ');

                if (empty($sizesInStock)) {
                    $sizesInStock = 'Tạm hết hàng';
                }

                return "- [ID: {$shoe->id}] {$shoe->name} | Danh mục: {$catName} | Giá: {$price} | Size sẵn có: {$sizesInStock} | Chi tiết: {$shoe->description}";
            })
            ->implode("\n");

        return <<<PROMPT
Bạn là nhân viên tư vấn bán giày chuyên nghiệp và nhiệt tình của cửa hàng "Simple Shop".

THÔNG TIN QUAN TRỌNG VỀ CỬA HÀNG:
1. "Simple Shop" LÀ CỬA HÀNG CHUYÊN VỀ GIÀY (Sneaker, Running, Basketball, Football, Casual).
2. CỬA HÀNG KHÔNG BÁN quần áo, phụ kiện hay các mặt hàng khác ngoài GIÀY.
   - Nếu khách hàng hỏi về quần áo, váy, đầm,... hãy lịch sự giải thích rằng shop chỉ chuyên kinh doanh các dòng giày thể thao và sneaker.

CÁC DANH MỤC GIÀY CỦA SHOP:
{$categories}

DANH SÁCH MỘT SỐ MẪU GIÀY HIỆN CÓ TẠI SHOP:
{$shoes}

BẢNG ĐO SIZE GIÀY CHUẨN (Tính theo chiều dài bàn chân):
- Size 36: bàn chân dài ~22.5 cm
- Size 37: bàn chân dài ~23.0 cm - 23.5 cm
- Size 38: bàn chân dài ~24.0 cm
- Size 39: bàn chân dài ~24.5 cm
- Size 40: bàn chân dài ~25.0 cm
- Size 41: bàn chân dài ~25.5 cm - 26.0 cm
- Size 42: bàn chân dài ~26.5 cm
- Size 43: bàn chân dài ~27.0 cm - 27.5 cm
- Size 44: bàn chân dài ~28.0 cm
- Size 45: bàn chân dài ~28.5 cm - 29.0 cm
* Mẹo tư vấn: Nếu khách có bàn chân bè hoặc mu bàn chân dày, hãy khuyên khách nên tăng thêm 0.5 đến 1 size để mang êm và thoải mái nhất.

NHIỆM VỤ VÀ QUY TẮC CỦA BẠN:
1. CHỈ TẬP TRUNG tư vấn các mẫu giày, gợi ý giày theo nhu cầu (chạy bộ Running, chơi bóng rổ Basketball, đá bóng Football, đi chơi dạo phố Sneaker/Casual).
2. Tư vấn chọn size giày dựa trên chiều dài bàn chân hoặc size giày khách thường mang.
3. Khi gợi ý sản phẩm, hãy dựa CHÍNH XÁC vào danh sách giày ở trên (nêu tên giày, danh mục, giá tiền và các size còn hàng), BẮT BUỘC chèn đường link HTML cho sản phẩm theo định dạng: <a href="/customer/products/{id}" target="_blank" class="fw-bold text-primary">{Tên sản phẩm}</a> (thay {id} bằng ID sản phẩm thực tế).
4. Giọng điệu thân thiện, chu đáo, sử dụng emoji phù hợp (👟, 🏀, ⚽, ✨). Câu trả lời ngắn gọn, súc tích (khoảng 2 - 4 câu, tối đa 120 từ).

CÂU HỎI CỦA KHÁCH HÀNG:
"{$message}"
PROMPT;
    }

    protected function fallbackReply(string $message): string
    {
        $lower = mb_strtolower($message, 'UTF-8');

        // Khách hỏi quần áo
        if (str_contains($lower, 'áo') || str_contains($lower, 'quần') || str_contains($lower, 'váy')) {
            return "Dạ Simple Shop là cửa hàng chuyên về **Giày thể thao & Sneaker** (Running, Basketball, Football, Sneaker, Casual), shop hiện không kinh doanh các mặt hàng quần áo ạ. Bạn cần tìm mẫu giày nào cứ nhắn cho mình nhé! 👟";
        }

        // Khách hỏi size giày
        if (str_contains($lower, 'size') || str_contains($lower, 'chân') || str_contains($lower, 'cm')) {
            return "Bảng quy đổi size giày chuẩn của Simple Shop:\n• Size 36-37: Chân 22.5 - 23.5cm\n• Size 38-39: Chân 24.0 - 24.5cm\n• Size 40-41: Chân 25.0 - 26.0cm\n• Size 42-43: Chân 26.5 - 27.5cm\n• Size 44-45: Chân 28.0 - 29.0cm\nNếu chân bè ngang bạn nên tăng 1 size để đi thoải mái nhé! Bạn đang đi size bao nhiêu?";
        }

        // Khách hỏi chạy bộ / running
        if (str_contains($lower, 'chạy') || str_contains($lower, 'running') || str_contains($lower, 'thể dục')) {
            return "Dạ với nhu cầu chạy bộ và tập luyện thể thao, bạn có thể tham khảo dòng **Running** (như Nike Air Max) với đệm khí êm ái, bảo vệ gót chân rất tốt. Bạn ghé mục **Product List** để xem chi tiết nhé! 🏃‍♂️";
        }

        // Khách hỏi bóng rổ / đá bóng
        if (str_contains($lower, 'bóng rổ') || str_contains($lower, 'basketball') || str_contains($lower, 'bóng đá') || str_contains($lower, 'football')) {
            return "Dạ shop có sẵn các dòng chuyên dụng: **Basketball** (như Air Jordan cổ cao/lửng ôm cổ chân) và **Football** (ôm chân, bám sân cực tốt). Bạn cần tìm size bao nhiêu ạ? 🏀⚽";
        }

        // Mặc định
        return "Xin chào! Mình là trợ lý của Simple Shop - Chuyên Giày thể thao & Sneaker chính hãng. Bạn cần tư vấn mẫu giày nào hay hỗ trợ đo size giày (từ size 36 đến 45) thì nhắn cho mình nhé! 👟";
    }
}
