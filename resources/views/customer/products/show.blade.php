@extends('customer.layouts.app')

@section('title', 'Product Detail')

@section('content')

    <h2>Product Detail</h2>

    <table border="1" cellpadding="8">

        <tr>

            <th>Name</th>

            <td>{{ $product->name }}</td>

        </tr>

        <tr>

            <th>Category</th>

            <td>{{ $product->category->name }}</td>

        </tr>

        <tr>

            <th>Price</th>

            <td>{{ number_format($product->price) }}</td>

        </tr>

        <tr>

            <th>Stock</th>

            <td>{{ $product->stock }}</td>

        </tr>

        <tr>

            <th>Description</th>

            <td>{{ $product->description }}</td>

        </tr>
        @if ($product->image)
            <tr>
                <th>Image</th>
                <td><img src = "{{ asset($product->image) }}" width="200px"></td>
            </tr>
        @endif

    </table>
    <br><br>
    @if ($product->stock > 0)
        <form action="{{ route('customer.cart.store') }}" method = 'POST'>
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label>Quantity</label>
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
            <br><br>
            <button type="submit">
                Add to Cart
            </button>
        </form>
    @else
        <p><strong>Out of stock</strong></p>
    @endif


    <br>

    <a href="{{ route('customer.products.index') }}">

        Back

    </a>

@endsection
