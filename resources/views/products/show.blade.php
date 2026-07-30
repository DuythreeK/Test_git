@extends('layouts.app')

@section('content')
    <h2>{{ $product->name }}</h2>

    <p>

        Category :

        {{ $product->category->name }}

    </p>

    <p>

        Price :

        {{ $product->price }}

    </p>

    <p>

        Stock :

        {{ $product->stock }}

    </p>

    <p>

        Description

    </p>

    <p>

        {{ $product->description }}

    </p>

    @if ($product->image)
        <img src="{{ asset($product->image) }}" width="200px">
    @endif
@endsection
