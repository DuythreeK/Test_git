@extends('layouts.app')

@section('content')
    <h2>Product List</h2>
    <form action="{{ route('products.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name">

        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min price">

        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max price">

        <select name="category">
            <option value="">-- Category --</option>
            @foreach (\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- <select name="stock">
            <option value="">-- Stock --</option>
            <option value="in_stock" {{ request('stock') == 'in_stock' ? 'selected' : '' }}>In stock</option>
        </select> --}}

        {{-- <select name="status">
            <option value="">-- Status --</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
        </select> --}}

        <button type="submit">Filter</button>
        <a href="{{ route('products.index') }}">Reset</a>
    </form>
    <a href="{{ route('products.create') }}">
        Add Product
    </a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach ($products as $product)
            <tr>

                <td>{{ $product->id }}</td>

                <td>{{ $product->name }}</td>

                <td>{{ $product->category->name }}</td>

                <td>{{ $product->price }}</td>

                <td>{{ $product->stock }}</td>
                <td>
                    @if ($product->status === 1)
                        Active
                    @elseif($product->status === 0)
                        Inactive
                    @endif
                </td>

                <td>

                    <a href="{{ route('products.show', $product) }}">View</a>

                    <a href="{{ route('products.edit', $product) }}">Edit</a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">

                        @csrf

                        @method('DELETE')

                        <button>Delete</button>

                    </form>

                </td>

            </tr>
        @endforeach

    </table>

    {{ $products->appends(request()->query())->links() }}
@endsection
