<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getAll()
    {
        $orders = Order::paginate(10);
        return $orders;
    }
    public function getById($id)
    {
        $order = Order::with(['user', 'orderItems'])->findOrFail($id);
        return $order;
    }
    public function getByCustomer()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return $orders;
    }
    public function getCheckoutItems(array $cartItemIds)
    {
        $cartItems = CartItem::with('product')
        ->whereIn('id', $cartItemIds)
        ->whereHas('cart', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return $cartItems;
    }
    public function storeOrder($validated)
    {
        DB::transaction(function () use ($validated) {
            $cartItems = $this->getCheckoutItems($validated['cart_items']);

            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item->product->price * $item->quantity;
            }
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'order_date' => now(),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'note' => $validated['note'],
            ]);


            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }
            CartItem::destroy($validated['cart_items']);
        });
    }
    public function updateStatus(Order $order, $status)
    {
        $order->update([
            'status' => $status
        ]);
    }
}
