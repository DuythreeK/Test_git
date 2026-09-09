<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getByUserId($userId)
    {
        $cart = Cart::with(['cartItems.variant.product', 'cartItems.variant.size'])->where('user_id', $userId)->first();
        return $cart;
    }
    public function store($validated): void
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->user()->id,
        ]);
        $cartItem = CartItem::where('product_variant_id', $validated['product_variant_id'])
            ->where('cart_id', $cart->id)->first();
        $variant = ProductVariant::findOrFail($validated['product_variant_id']);
        $currentQty = $cartItem ? $cartItem->quantity : 0;
        if ($currentQty + $validated['quantity'] > $variant->stock) {
            throw new Exception("Not enough stock available");
        }
        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $validated['product_variant_id'],
                'quantity' => $validated['quantity'],
            ]);
        }
    }

    public function updateQuantity(array $validated, $id)
    {
        $item = CartItem::with('variant')->findOrFail($id);
        if ($validated['quantity'] > $item->variant->stock) {
            throw new Exception("Not enough stock available");
        }
        $item->update([
            'quantity' => $validated['quantity'],
        ]);
    }
    public function destroyItem($id)
    {
        $result = CartItem::destroy($id);
        return $result;
    }
}
