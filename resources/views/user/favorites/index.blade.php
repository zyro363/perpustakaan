@extends('layouts.app')

@section('content')
<div class="row mb-5 align-items-center">
    <div class="col-md-12">
        <h2 class="fw-bold mb-0 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
            </svg>
            Buku Favorit Saya
        </h2>
        <p class="text-muted">Koleksi buku-buku yang Anda simpan.</p>
    </div>
</div>

<div class="row g-4">
    @forelse($favorites as $fav)
    @php $book = $fav->book; @endphp
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
                    @endif
                </a>
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
                </div>

                <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-light">
                    <form action="{{ route('favorite.toggle', $book->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger px-3 rounded-pill" onclick="return confirm('Hapus dari favorit?')">
                            Hapus
                        </button>
                    </form>
                    <a href="{{ route('user.book.show', $book->id) }}" class="btn btn-sm btn-primary px-3 rounded-pill">
                        Lihat
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="mb-3 opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-heart-break" viewBox="0 0 16 16">
                <path d="M8.867 14.41c13.308-9.322 4.79-15.006-1.71-5.895L7.1 8.65l.568.14c.22.055.435.12.645.195.45.158.895.344 1.335.556 3.193-4.246 11.776.49 1.155 7.828l-1.936-2.96ZM6.52 7.72 5.093 9.47l-.935-.61c-12.755-8.318 4.29-15.655 7.6-6.19a27 27 0 0 0-5.238 5.053" />
            </svg>
        </div>
        <h3 class="text-muted">Belum ada buku favorit 💔</h3>
        <p>Yuk cari buku menarik dan simpan di sini!</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">Cari Buku</a>
    </div>
    @endforelse
</div>
@endsection