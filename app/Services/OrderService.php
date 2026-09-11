<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getAll()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return $orders;
    }
    public function getById($id)
    {
        $order = Order::with(['user', 'orderItems.variant.product', 'orderItems.variant.size'])->findOrFail($id);
        return $order;
    }
    public function getByCustomer()
    {
        $orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return $orders;
    }
    public function getCheckoutItems(array $cartItemIds)
    {
        $cartItems = CartItem::with('variant.product', 'variant.size')
            ->whereIn('id', $cartItemIds)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        return $cartItems;
    }
    public function storeOrder(array $validated): Order
    {
        return DB::transaction(function () use ($validated) {
            $cartItems = $this->getCheckoutItems($validated['cart_items']);

            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item->variant->product->price * $item->quantity;
            }
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'order_date' => now(),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'note' => $validated['note'],
                'receiver_name' => $validated['receiver_name'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'] ?? 'cod',
                'payment_status' => 'unpaid',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->variant->id,
                    'quantity' => $item->quantity,
                    'price' => $item->variant->product->price,
                    'subtotal' => $item->variant->product->price * $item->quantity,
                ]);
                $variant = $item->variant;
                $variant->stock -= $item->quantity;
                $variant->save();
            }
            CartItem::destroy($validated['cart_items']);
            return $order;
        });
    }
    public function updateStatus(Order $order, $status)
    {
        $order->update([
            'status' => $status
        ]);
    }
}
