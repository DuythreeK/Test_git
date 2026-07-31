<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
</head>

<body>

    <h1>Simple Shop</h1>

    <hr>

    <a href="{{ route('home') }}">Home</a> |
    <a href="{{ route('customer.products.index') }}">Product List</a>|
    <a href="{{ route('customer.cart.index') }}">Cart</a> |
    {{-- <a href="{{ route('products.index') }}">Products</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('orders.index') }}">Orders</a> --}}

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">
            Log out
        </button>

    </form>
    <hr>

    @yield('content')

</body>

</html>
