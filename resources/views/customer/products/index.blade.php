@extends('customer.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5>
                    Filter Products
                </h5>
            </div>
            <div class="card-body">

                <form method="GET" action="{{ route('customer.products.index') }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Search</label>
                            <input type="text" name="search" value="{{ request('search') }}">
                        </div>

                        <br>

                        <div class="col-md-6">
                            <label>Category</label>

                            <select name="category">

                                <option value="">All</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">

                            <label>Min Price</label>

                            <input type="number" name="min_price" value="{{ request('min_price') }}">

                        </div>


                        <div class="col-md-6">

                            <label>Max Price</label>

                            <input type="number" name="max_price" value="{{ request('max_price') }}">

                        </div>

                        <div class="col-md-6">

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
                    </div>

                    <button type="submit" class="btn btn-outline-primary mt-4">

                        Filter

                    </button>

                </form>
            </div>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5>Product List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" border="1" cellpadding="8">
                        <thead class="table-dark">
                            <tr>

                                <th>Name</th>

                                <th>Category</th>

                                <th>Price</th>

                                <th>Stock</th>

                                <th></th>

                            </tr>
                        </thead>


                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>

                                <td>{{ $product->category->name }}</td>

                                <td>{{ number_format($product->price) }}</td>

                                <td>{{ $product->stock }}</td>

                                <td>

                                    <a href="{{ route('customer.products.show', $product) }}" class="btn btn-primary">

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
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>

    </div>

@endsection
