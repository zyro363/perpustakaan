@extends('layouts.app')
@section('content')
<div class="row mb-5 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold mb-0">📚 Daftar Buku</h2>
        <p class="text-muted">Temukan buku favoritmu untuk dipinjam.</p>
    </div>
    <div class="col-md-6">
        <form action="{{ route('user.dashboard') }}" method="GET">
            <div class="input-group">
                <select name="category_id" class="form-select" style="max-width: 150px;">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" class="form-control" placeholder="Cari judul buku..." value="{{ request('search') }}">
                <button class="btn btn-primary px-4">🔍 Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @forelse($books as $book)
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm feature-card">
            <!-- Cover Display -->
            <div class="card-img-top overflow-hidden" style="height: 300px;">
                @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $book->title }}">
                @else
                <div class="w-100 h-100 bg-gradient text-center d-flex align-items-center justify-content-center"
                    style="background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);">
                    <span style="font-size: 3rem;">📖</span>
                </div>
                @endif
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-truncate" title="{{ $book->title }}">{{ $book->title }}</h5>
                <span class="badge bg-secondary mb-2 align-self-start">{{ $book->category ? $book->category->name : 'Umum' }}</span>
                <p class="card-text small text-muted mb-1">✍️ {{ $book->writer }}</p>
                <p class="card-text small text-muted mb-3">🏢 {{ $book->publisher }} ({{ $book->year }})</p>

                <div class="mt-auto d-flex justify-content-between align-items-center">
                    <span class="badge {{ $book->stock > 0 ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }} px-3 py-2 rounded-pill">
                        Stok: {{ $book->stock }}
                    </span>
                    <form action="{{ route('borrow.book', $book->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm {{ $book->stock > 0 ? 'btn-primary' : 'btn-secondary' }}" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                            {{ $book->stock > 0 ? 'Pinjam' : 'Habis' }}
                        </button>
                    </form>
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
@endsection