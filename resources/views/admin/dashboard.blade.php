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
                        <span style="font-size: 3rem;">📚</span>
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
                        <span style="font-size: 3rem;">👥</span>
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
                        <span style="font-size: 3rem;">🔄</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection