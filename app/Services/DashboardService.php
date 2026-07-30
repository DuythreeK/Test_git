<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function getTotalProducts()
    {
        return Product::count();
    }
    public function getTotalCategories()
    {
        return Category::count();
    }
    public function getTotalUsers()
    {
        return User::count();
    }
    public function getTotalOrders()
    {
        return Order::count();
    }
    public function getTotalRevenue()
    {
        $totalRevenue = Order::query()
            ->selectRaw('SUM(total_price) as total_revenue')
            ->value('total_revenue');
        return $totalRevenue;

    }

    public function getTotalInventoryValue()
    {
        $totalInventoryValue =  Product::query()
            ->selectRaw('SUM( price*stock) as total_inventory_value')
            ->value('total_inventory_value');
        return $totalInventoryValue;
    }

    public function getTopExpensiveProducts()
    {
        $topExpensiveProducts = Product::query()
            ->withCount('orderItems')
            ->orderByDesc('price')
            ->limit(5)
            ->get();
        return $topExpensiveProducts;
    }
    public function getTopSellingProducts()
    {
        $topSellingProducts = OrderItem::query()
        ->selectRaw('product_id, SUM(quantity) as total_sold')
        ->with('product')
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

        return $topSellingProducts;
    }

    public function getTopStockProducts()
    {
        $topStockProducts = Product::query()
        ->orderByDesc('stock')
        ->limit(5)
        ->get();
        return $topStockProducts;
    }
}
