<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cartService;
    public function __construct()
    {
        $this->cartService = new CartService();
    }
    public function index(Request $request)
    {
        //
        $cart = $this->cartService->getByUserId(auth()->id());
        $cartItems = $cart ? $cart->cartItems : collect();
        return view('customer.cart.index', compact('cart', 'cartItems'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);
        $this->cartService->store($validated);
        return redirect()->route('customer.cart.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);
        $this->cartService->updateQuantity($validated, $id);
        return redirect()->route('customer.cart.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->cartService->detroyItem($id);
        return redirect()->route('customer.cart.index');
    }
}
