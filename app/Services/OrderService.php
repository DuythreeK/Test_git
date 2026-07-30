<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function getAll()
    {
        $order = Order::paginate(10);
        return $order;
    }
    public function getById($id)
    {
        $order = Order::with(['user', 'orderItems'])->findOrFail($id);
        return $order;
    }
}
