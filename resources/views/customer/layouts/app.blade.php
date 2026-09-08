<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    @yield('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="navbar-brand">Simple Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <item class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></item>
                <item class="nav-item"><a href="{{ route('customer.products.index') }}" class="nav-link">Product
                        List</a>
                </item>
                <item class="nav-item"><a href="{{ route('customer.cart.index') }}" class="nav-link">Cart</a></item>
                <item class="nav-item"><a href="{{ route('customer.orders.index') }}" class="nav-link">Orders</a></item>
            </ul>
        </div>
        {{-- LOGOUT --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light">
                Log out
            </button>
        </form>
    </nav>
    <main class="container flex-grow-1">
        <div class="text-center">
            <h1>Simple Shop</h1>
            <p class="text-muted">
                Welcome to our online store
            </p>
        </div>
        {{-- Success --}}
        @if (session('success'))
            <div style="color: green; background-color: white;" class="alert alert-sucess alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach

                    </ul>
                </div>

            @endif
        @endif
        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <footer class="bg-dark text-white text-center">
        <div class="container">
            <p>
                © 2026 Simple Shop
            </p>
        </div>
    </footer>
    {{-- <x-chatbot /> --}}
</body>

</html>
