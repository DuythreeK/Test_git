@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h2>{{ $product->name }}</h2>

                <p>
                    <strong>Category :</strong>
                    {{ $product->category->name }}
                </p>

                <p>
                    <strong>Price :</strong>

                    {{ $product->price }}
                </p>

                <p>
                    <strong>Sum stock</strong> :
                    {{ $product->variants->sum('stock') }}

                </p>
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Stock</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($product->variants ?? '' as $variant)
                            <tr>
                                <td>{{ $variant->size->name }}</td>
                                <td>{{ $variant->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                    <strong>Description:</strong>
                </p>

                <p>
                    {{ $product->description }}
                </p>

                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="200px">
                @endif
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-2">Back</a>
    </div>
@endsection
