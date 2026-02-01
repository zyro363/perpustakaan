@extends('layouts.app')
@section('content')
<div class="row mb-5 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold mb-0 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-journal-bookmark-fill text-primary" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 6.438l-2.243 2.99a.5.5 0 0 1-.912-.353l.513-2.07A.5.5 0 0 1 6.13 6.96l2.13 1.09L9 1h-3v5H6V1zm-1 0v7a.5.5 0 0 1-.9.3l-2.09-3.483A.5.5 0 0 1 2 4.5V1h3z" />
                <path fill-rule="evenodd" d="M2.5 0A2.5 2.5 0 0 0 0 2.5v11A1.5 1.5 0 0 0 1.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-2A1.5 1.5 0 0 0 12.5 10h-11A1.5 1.5 0 0 0 0 11.5v1A2.5 2.5 0 0 0 2.5 15h11a2.5 2.5 0 0 0 2.5-2.5v-10A2.5 2.5 0 0 0 13.5 0h-11z" />
            </svg>
            Daftar Buku
        </h2>
        <p class="text-muted">Temukan buku favoritmu untuk dipinjam.</p>
    </div>
    <div class="col-md-6">
        <form action="{{ route('user.dashboard') }}" method="GET">
            <div class="input-group drop-shadow-sm">
                <select name="category_id" class="form-select border-0" style="max-width: 200px; background-color: var(--bg-card);">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" class="form-control border-0 border-start" placeholder="Cari judul buku..." value="{{ request('search') }}">
                <button class="btn btn-primary px-4 d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @forelse($books as $book)
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 border-0 shadow-sm feature-card">
            <!-- Cover Display -->
            <div class="card-img-top overflow-hidden position-relative" style="height: 220px;">
                <a href="{{ route('user.book.show', $book->id) }}" class="text-decoration-none">
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
                </a>
                @endif
            </div>
            <div class="card-body d-flex flex-column p-3">
                <span class="badge bg-primary text-white mb-2 align-self-start" style="font-size: 0.75rem;">
                    {{ optional($book->category)->name ?: 'Umum' }}
                </span>

                <a href="{{ route('user.book.show', $book->id) }}" class="text-decoration-none text-reset">
                    <h6 class="card-title fw-bold text-truncate mb-1" title="{{ $book->title }}" style="font-size: 1.1rem;">{{ $book->title }}</h6>
                </a>

                <div class="small text-muted mb-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                        </svg>
                        {{ $book->writer }}
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>
                        {{ $book->year }}
                    </div>
                </div>

                <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-light">
                    <div class="d-flex flex-column">
                        <small class="text-muted" style="font-size: 0.7rem;">Stok</small>
                        <span class="fw-bold {{ $book->stock > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $book->stock }}
                        </span>
                    </div>
                    <a href="{{ route('user.book.show', $book->id) }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <h3 class="text-muted">Tidak ada buku ditemukan 😢</h3>
    </div>
    @endforelse
</div>

<!-- Modal Konfirmasi Peminjaman -->
<div class="modal fade" id="borrowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">📖 Konfirmasi Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin meminjam buku <strong id="modalBookTitle" class="text-primary">Judul Buku</strong>?</p>

                <div class="alert alert-warning border-0 d-flex gap-3 align-items-start">
                    <div style="font-size: 1.5rem;">⚠️</div>
                    <div>
                        <h6 class="fw-bold mb-1">Syarat & Ketentuan:</h6>
                        <ul class="mb-0 small ps-3">
                            <li>Buku wajib dikembalikan dalam <strong>{{ $duration }} hari</strong>.</li>
                            <li>Denda keterlambatan <strong>Rp {{ number_format($fine, 0, ',', '.') }}/hari</strong>.</li>
                            @foreach(explode("\n", $add_terms) as $term)
                            @if(trim($term))
                            <li>{{ trim($term) }}</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form id="borrowForm" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Saya Setuju, Pinjam Buku</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openBorrowModal(title, actionUrl) {
        document.getElementById('modalBookTitle').innerText = title;
        document.getElementById('borrowForm').action = actionUrl;

        var myModal = new bootstrap.Modal(document.getElementById('borrowModal'));
        myModal.show();
    }
</script>

@endsection