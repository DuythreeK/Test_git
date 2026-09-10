<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\VNPayService;
use App\Models\Order;
use Exception;

class OrderController extends Controller
{
    //
    protected $orderService;
    protected $vnpayService;
    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->vnpayService = new VNPayService();
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
                'receiver_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'shipping_address' => 'required|string',
                'note' => 'nullable|string',
                'payment_method' => 'required|in:cod,vnpay',
            ]);
            $order = $this->orderService->storeOrder($validated);

            if ($validated['payment_method'] === 'vnpay') {
                $paymentUrl = $this->vnpayService->createPaymentUrl($order);
                return redirect()->away($paymentUrl);
            }
            return redirect()->route('customer.cart.index')->with('success', 'Order successfully');
        } catch (Exception $e) {
            return redirect()->route('customer.cart.index')->withInput()->with('error', 'Order failed');
        }
    }

    public function vnpayReturn(Request $request)
    {
        if (!$this->vnpayService->validateSignature($request->all())) {
            return redirect()->route('customer.orders.index')->with('error', 'Invalid payment signature!');
        }

        $orderId = $request->get('vnp_TxnRef');
        $responseCode = $request->get('vnp_ResponseCode');
        $transactionId = $request->get('vnp_TransactionNo');

        $order = Order::findOrFail($orderId);
        if ($responseCode === '00') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'payment_transaction_id' => $transactionId,
                'payment_date' => now(),
            ]);
            return redirect()->route('customer.orders.index')->with('success', 'Your VNPay payment was successful!');
        }

        $order->update([
            'payment_status' => 'failed',
            'payment_transaction_id' => $transactionId,
        ]);
        return redirect()->route('customer.orders.index')->with('success', 'Your VNPay payment was unsuccessful or has been canceled.');
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
