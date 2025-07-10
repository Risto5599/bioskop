<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Tiket Bioskop')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Custom Styles --}}
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #0d6efd;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0b5ed7;
            font-weight: 500;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
        }
        .sidebar .nav-icon {
            width: 20px;
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar position-fixed top-0 start-0 p-3 text-white" style="width: 250px;">
            <h4 class="mb-4"><i class="bi bi-film me-2"></i>Tiket Bioskop</h4>
            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 nav-icon me-2"></i> Dashboard
            </a>
            <a href="{{ route('films.index') }}" class="{{ request()->is('films*') ? 'active' : '' }}">
                <i class="bi bi-camera-reels nav-icon me-2"></i> Daftar Film
            </a>
            <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}">
                <i class="bi bi-cup-hot nav-icon me-2"></i> Produk
            </a>
            <a href="{{ route('ticket-sales.index') }}" class="{{ request()->is('ticket-sales*') ? 'active' : '' }}">
                <i class="bi bi-ticket-perforated nav-icon me-2"></i> Transaksi Tiket
            </a>
            <a href="{{ route('product-sales.index') }}" class="{{ request()->is('product-sales*') ? 'active' : '' }}">
                <i class="bi bi-cart-check nav-icon me-2"></i> Transaksi Produk
            </a>
            <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}">
                <i class="bi bi-people nav-icon me-2"></i> Pengguna
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="content flex-grow-1">
            <div class="container-fluid">
                <h3 class="mb-4">@yield('page-title', 'Dashboard')</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
