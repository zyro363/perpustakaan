@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h3 class="fw-bold mb-4">⚙️ Pengaturan Pinjaman</h3>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Syarat & Ketentuan Peminjaman</h5>
                <p class="text-muted small">Atur teks yang akan muncul di pop-up konfirmasi peminjaman.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">📅 Durasi Peminjaman (Hari)</label>
                            <div class="input-group">
                                <input type="number" name="loan_duration" class="form-control" value="{{ $duration }}" min="1" required>
                                <span class="input-group-text bg-light">Hari</span>
                            </div>
                            <div class="form-text">Batas waktu pengembalian buku.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">💸 Denda Keterlambatan (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="fine_per_day" class="form-control" value="{{ $fine }}" min="0" required>
                                <span class="input-group-text bg-light">/ Hari</span>
                            </div>
                            <div class="form-text">Besaran denda per hari keterlambatan.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">📜 Syarat Tambahan</label>
                        <textarea name="additional_terms" class="form-control font-monospace" rows="6" placeholder="Tulis syarat tambahan disini...">{{ $terms }}</textarea>
                        <div class="form-text text-muted">
                            <span class="badge bg-secondary">Tips</span> Tulis setiap poin syarat pada <strong>baris baru</strong> agar otomatis menjadi daftar poin (bullet points).
                        </div>
                    </div>

                    <div class="d-flex justify-content-end border-top pt-3">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save me-1" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                            </svg>
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection