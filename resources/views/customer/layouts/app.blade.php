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
    <a href="{{ route('customer.orders.index') }}">Orders</a>
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

    {{-- Success --}}
    @if (session('success'))
        <div style="color: green; background-color: white;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if (session('error'))
        <div style="color: red; background-color: white;">
            {{ session('error') }}
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div style="color: red; background-color: white;">
                <ul>
                    @foreach ($errors as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
            </div>
            </ul>

        @endif
    @endif
    @yield('content')

</body>

</html>
