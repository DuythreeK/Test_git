<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'status',

    ];
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasManyThrough
    {
        return $this->hasManyThrough(
            OrderItem::class,
            ProductVariant::class,
            'product_id',
            'product_variant_id',
            'id',
            'id'
        );
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
