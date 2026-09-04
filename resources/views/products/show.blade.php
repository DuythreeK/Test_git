@extends('layouts.app')

@section('content')
    <div class="container">
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
                    <strong>Stock</strong> :
                    {{ $product->stock }}

                </p>

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
    </div>

@endsection