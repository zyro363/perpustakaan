<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>

<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                📚 Perpustakaan Digital
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @auth
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">Data Buku</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.transactions') ? 'active' : '' }}" href="{{ route('admin.transactions') }}">Laporan</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Cari Buku</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.borrowings') ? 'active' : '' }}" href="{{ route('user.borrowings') }}">Peminjaman Saya</a></li>
                    @endif
                    <li class="nav-item ms-md-2">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm px-3">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white px-4 py-2 mt-2 mt-lg-0" href="{{ route('register') }}" style="color: white !important;">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 mb-5 flex-grow-1">
        @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
            ✅ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
            ⚠️ {{ session('error') }}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @yield('content')
    </div>

    <footer>
        <div class="container">
            <small>&copy; {{ date('Y') }} Perpustakaan Digital UKK. Created with Laravel.</small>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>