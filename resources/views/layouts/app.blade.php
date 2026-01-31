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

<body>
    <script>
        // Check local storage or system preference
        const currentTheme = localStorage.getItem('theme') || 'dark';
        document.body.setAttribute('data-bs-theme', currentTheme);
    </script>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Perpustakaan Digital
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <button class="btn btn-link nav-link px-2" id="themeToggle" title="Toggle Theme">
                            <span id="themeIcon">☀️</span>
                        </button>
                    </li>
                    @auth
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">Data Buku</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Kategori Buku</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Data Anggota</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.transactions') ? 'active' : '' }}" href="{{ route('admin.transactions') }}">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">Pengaturan</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Cari Buku</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.borrowings') ? 'active' : '' }}" href="{{ route('user.borrowings') }}">Peminjaman Saya</a></li>
                    @endif
                    <li class="nav-item dropdown ms-md-2">
                        <a class="nav-link dropdown-toggle btn btn-outline-light px-3" href="#" role="button" data-bs-toggle="dropdown">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow-sm border-0">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}">
                                    ⚙️ Edit Profil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-secondary opacity-50">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                        🚪 Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
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

    <footer class="py-4 text-center text-muted border-top mt-5">
        <div class="container">
            <small>&copy; {{ date('Y') }} Perpustakaan Digital. All rights reserved.</small>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        function setTheme(theme) {
            document.body.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            themeIcon.textContent = theme === 'dark' ? '☀️' : '🌙';

            // Toggle navbar class for better visibility
            const navbar = document.querySelector('.navbar');
            if (theme === 'light') {
                navbar.classList.remove('navbar-dark');
                navbar.classList.add('navbar-light');

                // Update dropdown menus to light
                document.querySelectorAll('.dropdown-menu').forEach(el => {
                    el.classList.remove('dropdown-menu-dark');
                });

                // Update profile button
                // document.querySelectorAll('.btn-outline-light').forEach(el => {
                //     el.classList.remove('btn-outline-light');
                //     el.classList.add('btn-outline-dark');
                // });
            } else {
                navbar.classList.add('navbar-dark');
                navbar.classList.remove('navbar-light');

                document.querySelectorAll('.dropdown-menu').forEach(el => {
                    el.classList.add('dropdown-menu-dark');
                });

                // document.querySelectorAll('.btn-outline-dark').forEach(el => {
                //     el.classList.remove('btn-outline-dark');
                //     el.classList.add('btn-outline-light');
                // });
            }
        }

        const savedTheme = localStorage.getItem('theme') || 'dark';
        setTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.body.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });
    </script>
</body>

</html>