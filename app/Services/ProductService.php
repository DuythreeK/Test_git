<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAll(array $filters = [])
    {
        $products = Product::query()
        ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', (int) $status))
        ->when(
            $filters['search'] ?? null,
            fn ($q, $search) => $q->where('name', 'like', "%{$search}%")
        )
        ->when(
            $filters['category'] ?? null,
            fn ($q, $category) => $q->where('category_id', $category)
        )
        ->when(
            $filters['min_price'] ?? null,
            fn ($q, $min_price) => $q->where('price', '>=', $min_price)
        )
        ->when(
            $filters['max_price'] ?? null,
            fn ($q, $max_price) => $q->where('price', '<=', $max_price)
        )
        ->when(
            $filters['sort'] ?? null,
            fn ($q, $sort) => $q->orderBy('price', $sort)
        );
        return $products->paginate(15);

    }
    public function getById($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }
    public function store(array $product)
    {
        $product = Product::create($product);
        return $product;
    }
    public function destroy($id)
    {
        Product::destroy($id);
    }
    public function update(array $data, Product $product)
    {
        $product->update($data);
        return $product;
    }
}
