<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản trị hệ thống - Simple Shop')</title>

    {{-- Google Font: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5.3 & Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --admin-font: 'Inter', system-ui, -apple-system, sans-serif;
            --admin-sidebar-bg: #0f172a;
            /* Slate 900 */
            --admin-sidebar-hover: #1e293b;
            /* Slate 800 */
            --admin-sidebar-width: 260px;
            --admin-topbar-height: 64px;
            --admin-radius: 0.75rem;
            --admin-transition: all 0.2s ease-in-out;
        }

        body {
            font-family: var(--admin-font);
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background-color: var(--admin-sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            transition: var(--admin-transition);
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--admin-transition);
        }

        .admin-sidebar .nav-link i {
            font-size: 1.15rem;
        }

        .admin-sidebar .nav-link:hover {
            color: #f8fafc;
            background-color: var(--admin-sidebar-hover);
        }

        .admin-sidebar .nav-link.active {
            color: #ffffff;
            background-color: #2563eb;
            /* Primary Blue */
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }

        /* Main Wrapper */
        .admin-wrapper {
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--admin-transition);
        }

        /* Topbar Styling */
        .admin-topbar {
            height: var(--admin-topbar-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #ffffff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.95rem;
        }

        /* Responsive Mobile Sidebar */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-wrapper {
                margin-left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background-color: rgba(15, 23, 42, 0.5);
                z-index: 1035;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>

    @yield('style')
</head>

<body>

    {{-- SIDEBAR OVERLAY (Mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar p-3 shadow-sm" id="adminSidebar">
        {{-- BRAND LOGO --}}
        <div class="d-flex align-items-center justify-content-between mb-4 px-2 pt-2">
            <a href="{{ route('home') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                <i class="bi bi-lightning-charge-fill text-primary fs-4"></i>
                <div class="d-flex flex-column">
                    <span class="fw-bold fs-5 tracking-tight">Simple Shop</span>
                    <span class="text-secondary small" style="font-size: 0.7rem; letter-spacing: 0.5px;">ADMIN
                        PORTAL</span>
                </div>
            </a>
            <button type="button" class="btn btn-sm btn-dark text-secondary d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- NAVIGATION MENU --}}
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Báo cáo & Thống kê</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}"
                    class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="bi bi-boxes"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.index') }}"
                    class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Quản lý danh mục</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}"
                    class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Quản lý người dùng</span>
                </a>
            </li>
        </ul>

        <hr class="border-secondary my-3 opacity-25">

        {{-- USER INFO & LOGOUT --}}
        <div class="d-flex align-items-center justify-content-between p-2 rounded-3"
            style="background-color: rgba(255, 255, 255, 0.05);">
            <div class="d-flex align-items-center gap-2 overflow-hidden">
                <div class="avatar-circle flex-shrink-0" style="width: 34px; height: 34px; font-size: 0.85rem;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="d-flex flex-column text-truncate">
                    <span
                        class="text-white small fw-bold text-truncate">{{ auth()->user()->name ?? 'Quản trị viên' }}</span>
                    <span class="text-secondary" style="font-size: 0.725rem;">Admin</span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-sm text-secondary hover-text-white border-0 p-1" type="submit"
                    title="Đăng xuất">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN WRAPPER --}}
    <div class="admin-wrapper">
        {{-- TOPBAR --}}
        <header class="admin-topbar d-flex align-items-center justify-content-between px-3 px-lg-4 shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-light border d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <h5 class="mb-0 fw-bold text-dark d-none d-sm-block">@yield('title', 'Bảng quản trị')</h5>
            </div>

            <div class="d-flex align-items-center gap-3">
                {{-- Nút xem cửa hàng --}}
                <a href="{{ route('customer.products.index') }}"
                    class="btn btn-sm btn-outline-primary rounded-pill px-3 d-flex align-items-center gap-2">
                    <i class="bi bi-shop"></i>
                    <span class="d-none d-md-inline">Xem cửa hàng</span>
                </a>

                {{-- Thông tin tài khoản --}}
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar-circle">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="d-none d-md-flex flex-column text-end">
                        <span class="fw-semibold text-dark small">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="badge bg-success-subtle text-success border border-success-subtle"
                            style="font-size: 0.65rem;">Trực tuyến</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- FLASH MESSAGES --}}
        <div class="container-fluid px-3 px-lg-4 mt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0"
                    role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0"
                    role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0"
                    role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        {{-- MAIN CONTENT --}}
        <main class="flex-grow-1 p-3 p-lg-4">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="bg-white border-top py-3 text-center text-muted small mt-auto">
            <div class="container-fluid px-4">
                <span>© 2026 Simple Shop Management System. Đã tối ưu hóa giao diện.</span>
            </div>
        </footer>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
    </script>
    @yield('script')
</body>

</html>
