@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="col-md-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header text-center border-0 pt-4">
                <h3 class="mb-0">Selamat Datang</h3>
                <p class="text-muted small mt-2">Masuk untuk mulai meminjam buku</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required>
                    </div>
                    <button class="btn btn-primary w-100 btn-lg mb-3">Login</button>
                    <div class="text-center">
                        <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none">Daftar sekarang</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection