@extends('layouts.app')
@section('content')
<div class="auth-wrapper">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg">
            <div class="card-header text-center border-0 pt-4">
                <h3 class="mb-0">Pendaftaran Siswa</h3>
                <p class="text-muted small mt-2">Lengkapi data diri untuk bergabung</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIS</label>
                            <input type="number" name="nis" class="form-control" required placeholder="Nomor Induk Siswa">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="2" required placeholder="Alamat lengkap..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required placeholder="Username unik">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Minimal 4 karakter">
                        </div>
                    </div>

                    <button class="btn btn-success w-100 btn-lg mb-3">Daftar Sekarang</button>
                    <div class="text-center">
                        <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login disini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection