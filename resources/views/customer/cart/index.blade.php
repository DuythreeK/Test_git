@extends('customer.layouts.app')

@section('title', 'My Cart')

@section('content')
    <div class="container">

        {{-- <h2>My Cart</h2> --}}
        {{--
        @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
        @endif --}}
        @if ($cartItems->count())
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>
                        My Cart
                    </h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" border="1" cellpadding="10" cellspacing="0">
                            <thead class="table-dark">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="check-all" class="form-check-input">
                                    </th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($cartItems as $item)
                                    @php
                                        $subtotal = $item->variant->product->price * $item->quantity;
                                        $total += $subtotal;
                                    @endphp

                                    <tr>
                                        <td>
                                            <input type="checkbox" name="cart_items[]" value="{{ $item->id }}"
                                                class="item-checkbox form-check-input" form="checkout-form">
                                        </td>

                                        <td>

                                            @if ($item->variant->product->image)
                                                <img src="{{ asset('storage/' . $item->variant->product->image) }}"
                                                    class="img-thumnail" width="80">
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('customer.products.show', $item->variant->product) }}"
                                                class="nav-link">
                                                {{ $item->variant->product->name }}
                                            </a>

                                        </td>

                                        <td>
                                            Size {{ $item->variant->size->name }}
                                        </td>

                                        <td>

                                            {{ number_format($item->variant->product->price) }}

                                        </td>

                                        <td>

                                            <form action="{{ route('customer.cart.update', $item) }}" method="POST"
                                                class="d-flex gap-2 align-items-center">

                                                @csrf
                                                @method('PUT')

                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" max="{{ $item->variant->stock }}">

                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    Update
                                                </button>

                                            </form>

                                        </td>

                                        <td>

                                            {{ number_format($subtotal) }}

                                        </td>

                                        <td>

                                            <form action="{{ route('customer.cart.destroy', $item) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Remove this product?')"
                                                    class="btn btn-outline-danger">

                                                    Remove

                                                </button>

                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                        <br>
                        <form id="checkout-form" action="{{ route('customer.orders.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">
                                Check out
                            </button>
                        </form>

                        <br>

                        <h3>

                            Total :
                            {{ number_format($total) }}

                        </h3>

                        <br>

                        <a href="{{ route('customer.products.index') }}" class="btn btn-outline-secondary">

                            Continue Shopping

                        </a>


                    </div>
                </div>
            </div>
        @else
            <div class="card" class="shadow-sm">
                <div class="card-body text-center">
                    <h3>Your cart is empty.</h3>
                    <p class="text-muted"> Add some products to your cart before checking out. </p>
                    <a href="{{ route('customer.products.index') }}" class="btn btn-primary">
                        Go Shopping
                    </a>
                </div>

            </div>


        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            checkAll = document.getElementById('check-all');
            checkAll.addEventListener('change', function() {
                document.querySelectorAll('.item-checkbox').forEach(item => {
                    item.checked = this.checked;
                });
            });
        })
    </script>

@endsection
