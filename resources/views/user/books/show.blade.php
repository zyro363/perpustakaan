@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="card-body p-5">
                    <!-- Centered Header Section -->
                    <div class="text-center mb-5">
                        <!-- Cover Image with Shadow -->
                        <div class="mb-4 d-inline-block position-relative">
                            @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="img-fluid rounded-3 shadow-lg" style="max-height: 450px; width: auto; object-fit: cover;" alt="{{ $book->title }}">
                            @else
                            <div class="d-flex align-items-center justify-content-center text-white rounded-3 shadow-lg"
                                style="width: 300px; height: 450px; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-book opacity-50" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.169-1.997-.003-2.61.164-.78.213-1.597.51-1.99.65L2 12.392V3.118c-.326.11-.648.24-.96.398V2.828z" />
                                    <path d="M4.388 1.935C5.457 1.838 6.648 1.99 7.42 2.651c.773-.661 1.964-.813 3.032-.716.896.082 1.853.389 2.502.73v9.096c-.65-.341-1.558-.65-2.502-.73-1.069-.097-2.26.055-3.032.716-.773-.66-1.964-.813-3.032-.716-.897.081-1.854.388-2.502.73V3.18c.649-.342 1.558-.65 2.502-.73zM14 12.72c.677-.282 1.411-.564 2-.792V1.826c-.732.227-1.467.51-2.142.792l-1.858.749v9.354l2 1.748v-1.75z" />
                                </svg>
                            </div>
                            @endif
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <a href="{{ route('user.dashboard', ['category_id' => $book->category_id]) }}" class="badge bg-primary text-white px-4 py-2 rounded-pill text-decoration-none hover-scale fs-6">
                                {{ optional($book->category)->name ?: 'Umum' }}
                            </a>
                        </div>

                        <!-- Title & Author -->
                        <h1 class="display-5 fw-bold mb-2">{{ $book->title }}</h1>
                        <p class="text-muted h4 fw-light mb-0">{{ $book->writer }}</p>
                    </div>

                    <hr class="my-5 opacity-10">

                    <!-- Metadata Grid (Centered) -->
                    <div class="row justify-content-center text-center mb-5">
                        <div class="col-6 col-md-3 mb-4 mb-md-0 border-end border-light-subtle">
                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Penerbit</small>
                            <span class="fw-bold fs-5 text-dark">{{ $book->publisher }}</span>
                        </div>
                        <div class="col-6 col-md-3 mb-4 mb-md-0 border-end border-light-subtle">
                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Tahun Terbit</small>
                            <span class="fw-bold fs-5 text-dark">{{ $book->year }}</span>
                        </div>
                        <div class="col-6 col-md-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Stok</small>
                            <span class="fw-bold fs-5 {{ $book->stock > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $book->stock }} Buku
                            </span>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-10">
                            <h5 class="fw-bold text-center mb-3">Sinopsis</h5>
                            <p class="text-muted lead text-center" style="line-height: 1.9;">
                                {{ $book->synopsis ?? 'Belum ada sinopsis untuk buku ini.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row justify-content-center">
                        <div class="col-lg-6 d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            @if($book->stock > 0)
                            <button type="button" class="btn btn-primary btn-lg fw-bold shadow-sm px-5 flex-grow-1" data-bs-toggle="modal" data-bs-target="#confirmBorrowModal">
                                Pinjam Buku Ini
                            </button>
                            @else
                            <button class="btn btn-secondary btn-lg fw-bold shadow-sm px-5 flex-grow-1" disabled>
                                Stok Habis
                            </button>
                            @endif

                            <form action="{{ route('favorite.toggle', $book->id) }}" method="POST" class="d-flex">
                                @csrf
                                <button class="btn btn-outline-danger btn-lg px-4 flex-grow-1" title="{{ \App\Models\Favorite::where('user_id', auth()->id())->where('book_id', $book->id)->exists() ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
                                    @if(\App\Models\Favorite::where('user_id', auth()->id())->where('book_id', $book->id)->exists())
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.281 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <small class="text-muted">
                                * Buku harus dikembalikan tepat waktu untuk menghindari denda.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card border-0 shadow-lg mt-4 rounded-4">
                <div class="card-body p-4 p-lg-5">
                    <h4 class="fw-bold mb-4">⭐ Ulasan Pembaca</h4>

                    @php
                    $canReview = \App\Models\Borrowing::where('user_id', auth()->id())
                    ->where('book_id', $book->id)
                    ->where('status', 'dikembalikan')
                    ->exists()
                    && !\App\Models\Review::where('user_id', auth()->id())->where('book_id', $book->id)->exists();
                    @endphp

                    @if($canReview)
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Tulis Ulasan Anda</h5>
                            <form action="{{ route('book.review', $book->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <div class="rating-css">
                                        <div class="star-icon">
                                            <input type="radio" value="1" name="rating" checked id="rating1">
                                            <label for="rating1" class="fa fa-star">★</label>
                                            <input type="radio" value="2" name="rating" id="rating2">
                                            <label for="rating2" class="fa fa-star">★</label>
                                            <input type="radio" value="3" name="rating" id="rating3">
                                            <label for="rating3" class="fa fa-star">★</label>
                                            <input type="radio" value="4" name="rating" id="rating4">
                                            <label for="rating4" class="fa fa-star">★</label>
                                            <input type="radio" value="5" name="rating" id="rating5">
                                            <label for="rating5" class="fa fa-star">★</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Komentar</label>
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Bagaimana pendapat Anda tentang buku ini?" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            </form>
                        </div>
                    </div>
                    <!-- Simple Star Rating CSS -->
                    <style>
                        .rating-css div {
                            color: #ffe400;
                            font-size: 30px;
                            font-family: sans-serif;
                            font-weight: 800;
                            text-align: left;
                            text-transform: uppercase;
                            padding: 10px 0;
                        }

                        .rating-css input {
                            display: none;
                        }

                        .rating-css input+label {
                            font-size: 40px;
                            text-shadow: 1px 1px 0 #ffe400;
                            cursor: pointer;
                        }

                        .rating-css input:checked+label~label {
                            color: #838383;
                        }

                        .rating-css label:active {
                            transform: scale(0.8);
                            transition: 0.3s ease;
                        }
                    </style>
                    @endif

                    <!-- List Reviews -->
                    @forelse($book->reviews()->latest()->get() as $review)
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center gap-3">
                                @if($review->user->avatar)
                                <img src="{{ asset('storage/' . $review->user->avatar) }}" class="rounded-circle object-fit-cover shadow-sm" width="50" height="50">
                                @else
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                @endif
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $review->user->name }}</h6>
                                    <small class="text-muted" style="font-size: 0.85rem;">
                                        🕒 {{ $review->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-1 bg-light px-2 py-1 rounded-pill border">
                                <span class="text-warning fw-bold">★ {{ $review->rating }}</span>
                            </div>
                        </div>
                        <p class="text-secondary mb-0 ps-lg-5 ms-lg-2" style="line-height: 1.6;">"{{ $review->comment }}"</p>
                    </div>
                    @empty
                    <div class="text-center py-5 bg-light rounded-4">
                        <div class="mb-3 display-1">💬</div>
                        <h5 class="fw-bold text-muted">Belum ada ulasan</h5>
                        <p class="text-muted mb-0">Jadilah yang pertama memberikan ulasan untuk buku ini!</p>
                    </div>
                    @endforelse

                </div>
            </div>
            <!-- Borrow Confirmation Modal -->
            <div class="modal fade" id="confirmBorrowModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">Konfirmasi Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="alert alert-info border-0 d-flex align-items-center gap-3">
                                <span class="fs-1">📚</span>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $book->title }}</h6>
                                    <small class="mb-0 text-muted">{{ $book->writer }}</small>
                                </div>
                            </div>

                            <h6 class="fw-bold mt-4 mb-3">Ketentuan Peminjaman:</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                    <span>📅 Durasi Peminjaman</span>
                                    <span class="fw-bold">{{ $duration ?? 7 }} Hari</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                    <span>⚠️ Denda Keterlambatan</span>
                                    <span class="badgebtext-danger fw-bold">Rp {{ number_format($fine ?? 1000, 0, ',', '.') }} / hari</span>
                                </li>
                            </ul>

                            <div class="bg-light p-3 rounded-3 mb-4">
                                <small class="text-muted d-block fw-bold mb-1">Syarat & Ketentuan:</small>
                                <small class="text-muted d-block" style="line-height: 1.4;">
                                    {{ $add_terms ?? 'Harap menjaga kondisi buku. Kerusakan atau kehilangan akan dikenakan sanksi penggantian.' }}
                                </small>
                            </div>

                            <form action="{{ route('borrow.book', $book->id) }}" method="POST">
                                @csrf
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3">
                                        Saya Setuju & Pinjam Buku
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endsection