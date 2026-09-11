<!DOCTYPE html>
<html>

<head>
    <title>Mini Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex min-vh-100">
    <div class="d-flex bg-dark text-white p-3 flex-column" style="min-height: 100vh; width: 200px">
        <h4>Mini Shop Management</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-white">Home</a>
            </li>
            <li class="nav-item"><a href="{{ route('dashboard.index') }}" class="nav-link text-white">Dashboard</a>
            </li>
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link text-white">Products</a>
            </li>
            <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link text-white">Categories</a>
            </li>
            <li class="nav-item"><a href="{{ route('sizes.index') }}" class="nav-link text-white">Sizes</a>
            </li>
            <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link text-white">Orders</a></li>
        </ul>
        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-secondary" type="submit">
                    Log out
                </button>

            </form>
        </div>

    </div>
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <x-toast />
</body>

</html>