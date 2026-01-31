@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-lg">
    <div class="card-header border-0 bg-transparent py-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0 fw-bold">📚 Data Buku</h3>
            <p class="text-muted mb-0">Kelola koleksi buku perpustakaan.</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-lg shadow-sm">
            ➕ Tamah Buku
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background-color: var(--bg-hover)">
                    <tr>
                        <th class="py-3">Cover</th>
                        <th class="py-3">Judul Buku</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Penulis</th>
                        <th class="py-3">Penerbit</th>
                        <th class="py-3">Tahun</th>
                        <th class="py-3">Stok</th>
                        <th class="py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>
                            @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="rounded shadow-sm" style="width: 50px; height: 75px; object-fit: cover;">
                            @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 50px; height: 75px; font-size: 1.5rem;">📖</div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $book->title }}</td>
                        <td><span class="badge bg-secondary">{{ $book->category ? $book->category->name : 'Uncategorized' }}</span></td>
                        <td>{{ $book->writer }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td><span class="badge bg-info text-dark">{{ $book->year }}</span></td>
                        <td>
                            <span class="badge {{ $book->stock > 5 ? 'bg-success' : 'bg-danger' }}">
                                {{ $book->stock }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm text-dark btn-action">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-action">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <h4 class="text-muted">Belum ada data buku 📂</h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection