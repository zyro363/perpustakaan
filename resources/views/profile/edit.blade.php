@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header border-0 bg-transparent py-3">
                <h4 class="mb-0 fw-bold">👤 Profil Saya</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5 class="mb-3 text-muted">Informasi Dasar</h5>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->username }}" disabled readonly style="background-color: #e9ecef;">
                            <small class="text-muted">Username tidak dapat diubah.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'user')
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->nis }}" disabled readonly style="background-color: #e9ecef;">
                        <small class="text-muted">NIS tidak dapat diubah.</small>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3">{{ Auth::user()->address }}</textarea>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3 text-muted">Ganti Password</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-primary px-5">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection