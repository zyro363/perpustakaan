@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-lg">
    <div class="card-header border-0 bg-transparent py-4">
        <h3 class="mb-0 fw-bold">📋 Laporan Peminjaman</h3>
        <p class="text-muted mb-0">Riwayat transaksi peminjaman buku.</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="py-3">Peminjam</th>
                        <th class="py-3">Buku</th>
                        <th class="py-3">Tanggal Pinjam</th>
                        <th class="py-3">Tanggal Kembali</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $b)
                    <tr>
                        <td class="fw-bold">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ substr($b->user->name, 0, 2) }}
                                </div>
                                {{ $b->user->name }}
                            </div>
                        </td>
                        <td>{{ $b->book->title }}</td>
                        <td>{{ $b->borrow_date }}</td>
                        <td>{{ $b->return_date }}</td>
                        <td>
                            <span class="badge {{ $b->status == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }} px-3 py-2 rounded-pill">
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <h4 class="text-muted">Belum ada transaksi 💤</h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection