@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header border-0 bg-transparent py-3">
                <h4 class="mb-0 fw-bold">✏️ Edit Buku</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($book->cover)
                    <div class="mb-3 text-center">
                        <label class="form-label d-block">Cover Saat Ini</label>
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="img-thumbnail" style="height: 200px; object-fit: cover;">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control form-control-lg" value="{{ $book->title }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ganti Cover</label>
                            <input type="file" name="cover" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah cover.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text" name="writer" class="form-control" value="{{ $book->writer }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="year" class="form-control" value="{{ $book->year }}" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ $book->stock }}" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary px-4">Batal</a>
                        <button class="btn btn-primary px-5">Update Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection