@extends('layouts.app')
@section('content')
<h2 class="mb-4 fw-bold">Dashboard Admin</h2>
<div class="row g-4">
    <!-- Total Buku Card -->
    <div class="col-md-4">
        <a href="{{ route('admin.books.index') }}" class="text-decoration-none">
            <div class="card stat-card bg-primary text-white h-100 border-0 hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Total Buku</h6>
                            <h2 class="mb-0 fw-bold display-4 text-white">{{ $totalBooks }}</h2>
                        </div>
                        <div class="opacity-50 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.169-1.997-.003-2.61.164-.78.213-1.597.51-1.99.65L2 12.392V3.118c-.326.11-.648.24-.96.398V2.828z" />
                                <path d="M4.388 1.935C5.457 1.838 6.648 1.99 7.42 2.651c.773-.661 1.964-.813 3.032-.716.896.082 1.853.389 2.502.73v9.096c-.65-.341-1.558-.65-2.502-.73-1.069-.097-2.26.055-3.032.716-.773-.66-1.964-.813-3.032-.716-.897.081-1.854.388-2.502.73V3.18c.649-.342 1.558-.65 2.502-.73zM14 12.72c.677-.282 1.411-.564 2-.792V1.826c-.732.227-1.467.51-2.142.792l-1.858.749v9.354l2 1.748v-1.75z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-white-50 small d-flex align-items-center gap-1">
                        <span>Lihat Data Buku</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Data Anggota/Siswa Card -->
    <div class="col-md-4">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            <div class="card stat-card bg-success text-white h-100 border-0 hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Siswa Terdaftar</h6>
                            <h2 class="mb-0 fw-bold display-4 text-white">{{ $totalUsers }}</h2>
                        </div>
                        <div class="opacity-50 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-white-50 small d-flex align-items-center gap-1">
                        <span>Lihat Data Siswa</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Transaksi Card -->
    <div class="col-md-4">
        <a href="{{ route('admin.transactions') }}" class="text-decoration-none">
            <div class="card stat-card bg-warning text-dark h-100 border-0 hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Total Transaksi</h6>
                            <h2 class="mb-0 fw-bold display-4 text-white">{{ $totalBorrowings }}</h2>
                        </div>
                        <div class="opacity-50 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-white-50 small d-flex align-items-center gap-1">
                        <span>Lihat Laporan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Kategori Buku Card -->
    <div class="col-md-4">
        <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
            <div class="card stat-card bg-info text-white h-100 border-0 hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Manajemen</h6>
                            <h4 class="mb-0 fw-bold text-white">Kategori Buku</h4>
                        </div>
                        <div class="opacity-50 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                                <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-white-50 small d-flex align-items-center gap-1">
                        <span>Kelola Kategori</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Laporan Card -->
    <div class="col-md-4">
        <a href="{{ route('admin.transactions') }}" class="text-decoration-none">
            <div class="card stat-card bg-danger text-white h-100 border-0 hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Laporan</h6>
                            <h4 class="mb-0 fw-bold text-white">Cetak Laporan</h4>
                        </div>
                        <div class="opacity-50 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-white-50 small d-flex align-items-center gap-1">
                        <span>Lihat & Cetak</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Pengaturan Card -->
    <div class="col-md-4">
        <a href="{{ route('admin.settings.index') }}" class="text-decoration-none">
            <div class="card stat-card bg-secondary text-white h-100 border-0 hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-2">Sistem</h6>
                            <h4 class="mb-0 fw-bold text-white">Pengaturan</h4>
                        </div>
                        <div class="opacity-50 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-white-50 small d-flex align-items-center gap-1">
                        <span>Konfigurasi Sistem</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </div>
                </div>
        </a>
    </div>
</div>

</div>

<div class="d-flex justify-content-between align-items-center mt-5 mb-3">
    <h4 class="mb-0 fw-bold">📉 Aktivitas & Data Terbaru</h4>
    <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex align-items-center gap-2 card flex-row p-2 shadow-sm border-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul text-muted" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
        </svg>
        <span class="text-muted small">Tampilkan:</span>
        <select name="limit" class="form-select form-select-sm border-0 bg-transparent py-0 ps-2 pe-4 fw-bold" style="width: auto; cursor: pointer;" onchange="this.form.submit()">
            <option value="5" {{ request('limit') == 5 ? 'selected' : '' }}>5 Baris</option>
            <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10 Baris</option>
            <option value="20" {{ request('limit') == 20 ? 'selected' : '' }}>20 Baris</option>
        </select>
    </form>
</div>

<div class="row mt-4">
    <!-- Peminjaman Terbaru -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">📋 {{ $limit }} Peminjaman Terbaru</h5>
                <a href="{{ route('admin.transactions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: var(--bg-hover)">
                            <tr>
                                <th class="px-4 py-3 border-0">Peminjam</th>
                                <th class="px-4 py-3 border-0">Buku</th>
                                <th class="px-4 py-3 border-0">Tanggal</th>
                                <th class="px-4 py-3 border-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestTransactions as $t)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                            {{ substr($t->user->name, 0, 2) }}
                                        </div>
                                        <span class="fw-medium">{{ Str::limit($t->user->name, 15) }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ Str::limit($t->book->title, 20) }}</td>
                                <td class="px-4 py-3 text-muted small">{{ $t->borrow_date }}</td>
                                <td class="px-4 py-3">
                                    @if($t->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                    @elseif($t->status == 'dikembalikan')
                                    <span class="badge bg-success">Kembali</span>
                                    @else
                                    <span class="badge bg-danger">Denda</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Anggota Baru -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">👥 {{ $limit }} Anggota Baru</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: var(--bg-hover)">
                            <tr>
                                <th class="px-4 py-3 border-0">Nama</th>
                                <th class="px-4 py-3 border-0">Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestUsers as $u)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                            {{ substr($u->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ Str::limit($u->name, 15) }}</div>
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ $u->nis ?? 'No NIS' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-muted small text-end">{{ $u->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">Belum ada anggota.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4 mb-5">
    <!-- Buku Terbaru -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">📚 {{ $limit }} Buku Terbaru</h5>
                <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: var(--bg-hover)">
                            <tr>
                                <th class="px-4 py-3 border-0">Judul</th>
                                <th class="px-4 py-3 border-0">Kategori</th>
                                <th class="px-4 py-3 border-0">Stok</th>
                                <th class="px-4 py-3 border-0">Ditambahkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestBooks as $book)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="rounded shadow-sm" style="width: 30px; height: 45px; object-fit: cover;">
                                        @else
                                        <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 30px; height: 45px; font-size: 1rem;">📖</div>
                                        @endif
                                        <span class="fw-medium">{{ Str::limit($book->title, 30) }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-secondary">{{ $book->category ? $book->category->name : '-' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $book->stock }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-muted small">{{ $book->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada buku.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Terbaru -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">🏷️ {{ $limit }} Kategori Terbaru</h5>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: var(--bg-hover)">
                            <tr>
                                <th class="px-4 py-3 border-0">Nama</th>
                                <th class="px-4 py-3 border-0">Total Buku</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestCategories as $cat)
                            <tr>
                                <td class="px-4 py-3 fw-medium">{{ $cat->name }}</td>
                                <td class="px-4 py-3 text-end">
                                    <span class="badge bg-info text-dark">{{ $cat->books_count }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">Belum ada kategori.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection