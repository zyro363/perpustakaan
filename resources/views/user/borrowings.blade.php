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
                            @if($b->fine > 0)
                            <span class="badge bg-danger">Rp {{ number_format($b->fine, 0, ',', '.') }}</span>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $b->status == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ ucfirst($b->status) }}
                            </span>
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