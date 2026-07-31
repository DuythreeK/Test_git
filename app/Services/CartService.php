<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getByUserId($userId)
    {
        $cart = Cart::with('cartItems.product')->where('user_id', $userId)->first();
        return $cart;
    }
    public function store($validated): void
    {
        $cart = Cart::firstOrCreate([
        'user_id' => auth()->user()->id,
        ]);
        $cartItem = CartItem::where('product_id', $validated['product_id'])
        ->where('cart_id', $cart->id)->first();
        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }
    }
    public function updateQuantity(array $validated, $id)
    {
        $item = CartItem::findOrFail($id);
        $item->update([
            'quantity' => $validated['quantity'],
        ]);
    }
    public function detroyItem($id)
    {
        $result = CartItem::destroy($id);
        return $result;
    }
}
