@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-lg">
    <div class="card-header border-0 bg-transparent py-3">
        <h3 class="mb-0">📚 Peminjaman Saya</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tenggat</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $b)
                    <tr>
                        <td class="fw-bold">{{ $b->book->title }}</td>
                        <td>{{ $b->borrow_date }}</td>
                        <td>{{ $b->return_date }}</td>
                        <td>
                            @php
                            $returnDate = \Carbon\Carbon::parse($b->return_date)->startOfDay();
                            $now = \Carbon\Carbon::now()->startOfDay();
                            $isOverdue = $b->status == 'dipinjam' && $now->gt($returnDate);
                            $daysLate = $isOverdue ? $now->diffInDays($returnDate) : 0;
                            $estFine = $daysLate * ($finePerDay ?? 1000);
                            @endphp

                            @if($b->fine != 0)
                            <div class="text-danger fw-bold" style="font-size: 0.85rem;">
                                Terlambat<br>
                                Denda: Rp {{ number_format(abs($b->fine), 0, ',', '.') }}
                            </div>
                            @elseif($isOverdue)
                            <div class="text-danger fw-bold" style="font-size: 0.85rem;">
                                Telat {{ $daysLate }} Hari<br>
                                (Estimasi: Rp {{ number_format($estFine, 0, ',', '.') }})
                            </div>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($b->status == 'dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                            @elseif($b->status == 'denda_belum_lunas')
                            <span class="badge bg-danger">Menunggu Pembayaran</span>
                            @else
                            <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if($b->status == 'dipinjam')
                            <form action="{{ route('return.book', $b->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm px-3">Kembalikan</button>
                            </form>
                            @else
                            <span class="text-muted small">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada history peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection