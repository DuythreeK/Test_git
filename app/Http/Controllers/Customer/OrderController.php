<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Exception;

class OrderController extends Controller
{
    //
    protected $orderService;
    public function __construct()
    {
        $this->orderService = new OrderService();
    }
    public function checkout(Request $request)
    {
        $validated = $request->validate(
            [
                'cart_items' => 'required',
                'cart_items.*' => 'exists:cart_items,id',
            ]
        );
        $cartItems = $this->orderService->getCheckoutItems($validated['cart_items']);
        return view('customer.orders.checkout', [
            'cartItems' => $cartItems
        ]);
    }
    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
            'cart_items' => 'required',
            'cart_items.*' => 'exists:cart_items,id',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'note' => 'nullable|string',

        ]);
            $this->orderService->storeOrder($validated);
            return redirect()->route('customer.cart.index')->with('success', 'Order  successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('customer.cart.index')->withInput()->with('error', 'Order failed');
        }

    }
    public function index()
    {
        // dd('index');
        $orders = $this->orderService->getByCustomer();
        // dd($orders);
        return view('customer.orders.index', [
            'orders' => $orders,
        ]);
    }
}
