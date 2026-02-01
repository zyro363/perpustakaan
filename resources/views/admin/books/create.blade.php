@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header border-0 bg-transparent py-3">
                <h4 class="mb-0 fw-bold">➕ Tambah Buku Baru</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control form-control-lg" required placeholder="Masukkan judul buku...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sinopsis</label>
                        <textarea name="synopsis" class="form-control" rows="4" placeholder="Ringkasan atau deskripsi buku..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cover Buku</label>
                            <input type="file" name="cover" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text" name="writer" class="form-control" required placeholder="Nama penulis">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="publisher" class="form-control" required placeholder="Nama penerbit">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="year" class="form-control" required placeholder="2024">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" name="stock" class="form-control" required placeholder="Jumlah stok">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary px-4">Batal</a>
                        <button class="btn btn-primary px-5">Simpan Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection