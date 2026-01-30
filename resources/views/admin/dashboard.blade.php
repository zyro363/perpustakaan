@extends('layouts.app')
@section('content')
<h2 class="mb-4 fw-bold">Dashboard Admin</h2>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card stat-card bg-primary text-white h-100 border-0">
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
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-success text-white h-100 border-0">
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
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-warning text-dark h-100 border-0">
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
            </div>
        </div>
    </div>
</div>
@endsection