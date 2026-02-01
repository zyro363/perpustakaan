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
                            <button type="button" class="btn btn-success btn-sm px-3" data-bs-toggle="modal" data-bs-target="#returnModal{{ $b->id }}">
                                Kembalikan
                            </button>

                            <!-- Return Modal -->
                            <div class="modal fade" id="returnModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-start">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Kembalikan Buku</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('return.book', $b->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin mengembalikan buku <strong>{{ $b->book->title }}</strong>?</p>

                                                <hr>
                                                <h6 class="fw-bold mb-2">Beri Ulasan (Opsional)</h6>
                                                <p class="small text-muted mb-2">Bagaimana pengalaman Anda membaca buku ini?</p>

                                                <div class="mb-3">
                                                    <label class="form-label">Rating</label>
                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            <input type="radio" value="1" name="rating" id="rating1-{{ $b->id }}" checked>
                                                            <label for="rating1-{{ $b->id }}" class="fa fa-star">★</label>
                                                            <input type="radio" value="2" name="rating" id="rating2-{{ $b->id }}">
                                                            <label for="rating2-{{ $b->id }}" class="fa fa-star">★</label>
                                                            <input type="radio" value="3" name="rating" id="rating3-{{ $b->id }}">
                                                            <label for="rating3-{{ $b->id }}" class="fa fa-star">★</label>
                                                            <input type="radio" value="4" name="rating" id="rating4-{{ $b->id }}">
                                                            <label for="rating4-{{ $b->id }}" class="fa fa-star">★</label>
                                                            <input type="radio" value="5" name="rating" id="rating5-{{ $b->id }}">
                                                            <label for="rating5-{{ $b->id }}" class="fa fa-star">★</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Komentar</label>
                                                    <textarea name="comment" class="form-control" rows="2" placeholder="Tulis pendapat Anda..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Kembalikan & Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

<style>
    .rating-css div {
        color: #ffe400;
        font-size: 30px;
        font-family: sans-serif;
        font-weight: 800;
        text-align: left;
        text-transform: uppercase;
        padding: 0;
    }

    .rating-css input {
        display: none;
    }

    .rating-css input+label {
        font-size: 30px;
        text-shadow: 1px 1px 0 #ffe400;
        cursor: pointer;
    }

    .rating-css input:checked+label~label {
        color: #838383;
    }

    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }
</style>
@endsection