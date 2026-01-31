@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="row align-items-center mb-5 py-5 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); position: relative; overflow: hidden;">
    <!-- Abstract Shapes -->
    <div style="position: absolute; top: -50%; left: -20%; width: 80%; height: 200%; background: radial-gradient(circle, rgba(99,102,241,0.1) 0%, rgba(99,102,241,0) 70%); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50%; right: -20%; width: 80%; height: 200%; background: radial-gradient(circle, rgba(168,85,247,0.1) 0%, rgba(168,85,247,0) 70%); border-radius: 50%; pointer-events: none;"></div>

    <div class="col-lg-7 px-5 text-white position-relative" style="z-index: 1;">
        <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">
            Perpustakaan Sekolah <br>
            <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #818cf8, #c084fc);">Berbasis Online</span>
        </h1>
        <p class="lead text-white-50 mb-4" style="max-width: 600px;">
            Platform digital untuk meningkatkan minat baca dan mempermudah akses literasi bagi seluruh siswa dan warga sekolah SMKN 2 Padang Panjang.
        </p>
        <div class="d-flex gap-3">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 py-2 border-0 shadow-lg" style="background: linear-gradient(to right, #6366f1, #8b5cf6);">
                Mulai Membaca
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                Masuk Akun
            </a>
        </div>
        <div class="mt-4 pt-4 border-top border-white border-opacity-10 d-flex gap-5 text-white-50">
            <div>
                <h5 class="fw-bold text-white mb-0">{{ $totalBooks }}+</h5>
                <small>Koleksi Buku</small>
            </div>
            <div>
                <h5 class="fw-bold text-white mb-0">{{ $totalUsers }}+</h5>
                <small>Siswa Terdaftar</small>
            </div>
            <div>
                <h5 class="fw-bold text-white mb-0">24 Jam</h5>
                <small>Akses Online</small>
            </div>
        </div>
    </div>
    <div class="col-lg-5 d-none d-lg-block position-relative" style="height: 400px;">
        <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
            <!-- 3D Book Illustration Placeholder -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="300" height="300" fill="url(#grad1)">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#6366f1;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#a855f7;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M464 64H48C21.49 64 0 85.49 0 112v320c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zM192 416H64v-64h128v64zm0-96H64v-64h128v64zm0-96H64v-64h128v64zm176 192H240v-64h128v64zm0-96H240v-64h128v64zm0-96H240v-64h128v64z" opacity="0.8" />
                <path d="M288 64V32c0-17.673-14.327-32-32-32s-32 14.327-32 32v32h64z" fill="#a855f7" />
            </svg>
        </div>
    </div>
</div>

<!-- Latest Books Section -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-1">📚 Koleksi Terbaru</h2>
            <p class="text-muted mb-0">Buku-buku yang baru saja ditambahkan ke perpustakaan.</p>
        </div>
        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none">Lihat Semua &rarr;</a>
    </div>

    <div class="row g-4">
        @forelse($books as $book)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm feature-card">
                <!-- Cover Display -->
                <div class="card-img-top overflow-hidden position-relative" style="height: 220px;">
                    @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $book->title }}">
                    @else
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white"
                        style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-book opacity-50" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.169-1.997-.003-2.61.164-.78.213-1.597.51-1.99.65L2 12.392V3.118c-.326.11-.648.24-.96.398V2.828z" />
                            <path d="M4.388 1.935C5.457 1.838 6.648 1.99 7.42 2.651c.773-.661 1.964-.813 3.032-.716.896.082 1.853.389 2.502.73v9.096c-.65-.341-1.558-.65-2.502-.73-1.069-.097-2.26.055-3.032.716-.773-.66-1.964-.813-3.032-.716-.897.081-1.854.388-2.502.73V3.18c.649-.342 1.558-.65 2.502-.73zM14 12.72c.677-.282 1.411-.564 2-.792V1.826c-.732.227-1.467.51-2.142.792l-1.858.749v9.354l2 1.748v-1.75z" />
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start" style="font-size: 0.75rem;">
                        {{ $book->category ? $book->category->name : 'Umum' }}
                    </span>

                    <h6 class="card-title fw-bold text-truncate mb-1" title="{{ $book->title }}" style="font-size: 1.1rem;">{{ $book->title }}</h6>

                    <div class="small text-muted mb-3">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                            </svg>
                            {{ $book->writer }}
                        </div>
                    </div>

                    <div class="mt-auto pt-3 border-top border-light text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 btn-sm">
                            Login untuk Pinjam
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">Belum ada buku 😢</h3>
        </div>
        @endforelse
    </div>
</div>

<!-- Features Section -->
<div class="row g-4 py-5 mb-5 border-top border-light">
    <div class="col-md-4 text-center">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 80px; height: 80px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.027 7.027 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.433l-.707-.708z" />
                <path d="M8 1a7 7 0 1 0 4.95 4.95A7 7 0 0 0 8 1M0 8a8 8 0 1 1 14.027-3.927q.023.965.023 1.927c0 4.418-3.582 8-8 8s-8-3.582-8-8" />
                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
            </svg>
        </div>
        <h5>Peminjaman Mudah</h5>
        <p class="text-muted">Proses peminjaman cepat dan bisa dilakukan kapan saja dimana saja.</p>
    </div>
    <div class="col-md-4 text-center">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle" style="width: 80px; height: 80px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.826 7.197 2.573 10.191l.001.002.001.001c.164.282.474.55.858.74.455.228.96.228 1.415 0 .384-.19.694-.458.858-.74l.002-.005.002-.002c1.745-2.99 3.124-6.028 2.57-10.187a.481.481 0 0 0-.329-.396 61.734 61.734 0 0 0-2.837-.85C8.895 1.565 7.025 1.565 5.338 1.59zM8 2.074c.905.03 2.064.409 3.136.966-.554 3.79-1.802 6.578-3.133 8.948-1.328-2.373-2.576-5.163-3.132-8.947 1.073-.558 2.232-.937 3.129-.967z" />
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
            </svg>
        </div>
        <h5>Aman & Terpercaya</h5>
        <p class="text-muted">Data anggota dan transaksi dijamin aman dengan sistem terenkripsi.</p>
    </div>
    <div class="col-md-4 text-center">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle" style="width: 80px; height: 80px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-collection" viewBox="0 0 16 16">
                <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z" />
            </svg>
        </div>
        <h5>Koleksi Lengkap</h5>
        <p class="text-muted">Ribuan judul buku dari berbagai kategori siap untuk Anda baca.</p>
    </div>
</div>
@endsection