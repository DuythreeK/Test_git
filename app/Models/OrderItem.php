<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'price',
        'subtotal',
    ];
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'order_item_id');
    }

    public function getProductAttribute()
    {
        return $this->variant->product;
    }
    public function canReview()
    {
        $order = $this->order;
        if (!$order) {
            return false;
        }

        if ($order->user_id !== auth()->id()) {
            return false;
        }
        if ($order->status !== 'completed') {
            return false;
        }
        if ($this->review()->exists()) {
            return false;
        }
        return true;
    }

}
