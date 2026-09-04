@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="text-center">
            <h2>Product List</h2>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5>Filter Products</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET" style="margin-bottom: 20px;">
                    <div class="row g-3">    
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="search">Search</label>
                            <input class="form-control" type="text" name="search" id="search"
                                value="{{ request('search') }}" placeholder="Search by name">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="min-price" class="form-label">Min price</label>
                            <input class="form-control" type="number" name="min_price" id="min-price"
                                value="{{ request('min_price') }}" placeholder="Min price">

                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="max_price" class="form-label">Max price</label>
                            <input class="form-control" type="number" name="max_price" id="max-price"
                                value="{{ request('max_price') }}" placeholder="Max price">

                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="category">Category</label>
                            <select class="form-select" name="category">
                                <option value="">-- Category --</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- <select name="stock">
                            <option value="">-- Stock --</option>
                            <option value="in_stock" {{ request('stock')=='in_stock' ? 'selected' : '' }}>In stock</option>
                        </select> --}}

                        {{-- <select name="status">
                            <option value="">-- Status --</option>
                            <option value="1" {{ request('status')=='1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status')=='0' ? 'selected' : '' }}>Inactive</option>
                        </select> --}}
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary" type="submit">Filter</button>
                            <a class="btn btn-outline-success" href="{{ route('products.index') }}">Reset</a>
                        </div>

                    </div>
                </form>
                    <a class="btn btn-primary" href="{{ route('products.create') }}">
                        Add Product
                    </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Product List</h5>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>

                                            <td>{{ $product->id }}</td>

                                            <td>{{ $product->name }}</td>

                                            <td>{{ $product->category->name }}</td>

                                            <td>{{ number_format($product->price) }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>

                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>



                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if ($product->status === 1)
                                                    Active
                                                @elseif($product->status === 0)
                                                    Inactive
                                                @endif
                                            </td>

                                            <td>

                                                <a class="btn btn-primary" href="{{ route('products.show', $product) }}">View</a>

                                                <a class="btn btn-success" href="{{ route('products.edit', $product) }}">Edit</a>

                                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                    style="display:inline">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button class="btn btn-danger">Delete</button>

                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
</div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
        </div>
        
    </div>


@endsection