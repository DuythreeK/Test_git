<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'rating' => 'required|integer|min:1,max:5',
            'comment' => 'nullable|string|max:1000'
        ]);
        $orderItem = OrderItem::with('order')->findOrFail($validated['order_item_id']);
        if (!$orderItem->canReview()) {
            return back()->with('error', 'Mặt hàng này không hợp lệ hoặc đã đươc đánh giá trước đó.');
        }
        Review::create([
            'user_id' => auth()->id(),
            'order_item_id' => $orderItem->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);
        return back()->with('success', 'Gửi đánh giá thành công!');
    }
}
