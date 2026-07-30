@extends('customer.layouts.app')

@section('title', 'Products')

@section('content')

    <h2>Product List</h2>

    <form method="GET" action="{{ route('customer.products.index') }}">

        <div>
            <label>Search</label>
            <input type="text" name="search" value="{{ request('search') }}">
        </div>

        <br>

        <div>
            <label>Category</label>

            <select name="category">

                <option value="">All</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>
                @endforeach

            </select>
        </div>

        <br>

        <div>

            <label>Min Price</label>

            <input type="number" name="min_price" value="{{ request('min_price') }}">

        </div>

        <br>

        <div>

            <label>Max Price</label>

            <input type="number" name="max_price" value="{{ request('max_price') }}">

        </div>

        <br>

        <div>

            <label>Sort</label>

            <select name="sort">

                <option value="">Default</option>

                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>

                    Price Low -> High

                </option>

                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>

                    Price High -> Low

                </option>

            </select>

        </div>

        <br>

        <button type="submit">

            Filter

        </button>

    </form>

    <hr>

    <table border="1" cellpadding="8">

        <tr>

            <th>Name</th>

            <th>Category</th>

            <th>Price</th>

            <th>Stock</th>

            <th></th>

        </tr>

        @forelse($products as $product)
            <tr>

                <td>{{ $product->name }}</td>

                <td>{{ $product->category->name }}</td>

                <td>{{ number_format($product->price) }}</td>

                <td>{{ $product->stock }}</td>

                <td>

                    <a href="{{ route('customer.products.show', $product) }}">

                        Detail

                    </a>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5">

                    No products

                </td>

            </tr>
        @endforelse

    </table>

    <br>

    {{ $products->appends(request()->query())->links() }}

@endsection
