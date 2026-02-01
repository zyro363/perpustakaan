<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    // User Section
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->get();
        $categories = \App\Models\Category::all();

        // Fetch Settings
        $duration = \App\Models\Setting::where('key', 'loan_duration')->value('value') ?? 7;
        $fine = \App\Models\Setting::where('key', 'fine_per_day')->value('value') ?? 1000;
        $add_terms = \App\Models\Setting::where('key', 'additional_terms')->value('value') ?? "Buku yang hilang atau rusak wajib diganti.";

        return view('user.dashboard', compact('books', 'categories', 'duration', 'fine', 'add_terms'));
    }

    public function borrow(Book $book)
    {
        if ($book->stock <= 0) {
            return back()->with('error', 'Buku Habis');
        }

        DB::transaction(function () use ($book) {
            Borrowing::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'borrow_date' => now(),
                'return_date' => now()->addDays((int) (\App\Models\Setting::where('key', 'loan_duration')->value('value') ?? 7)),
                'status' => 'dipinjam'
            ]);

            $book->decrement('stock');
        });

        return back()->with('success', 'Buku Dipinjam');
    }

    public function borrowings()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $borrowings = $user->borrowings()->with('book')->get();
        $finePerDay = (int) (\App\Models\Setting::where('key', 'fine_per_day')->value('value') ?? 1000);
        return view('user.borrowings', compact('borrowings', 'finePerDay'));
    }

    public function returnBook(Request $request, Borrowing $borrowing)
    {
        // Ensure user owns this borrowing
        if ($borrowing->user_id !== Auth::id()) {
            abort(403);
        }

        if ($borrowing->status === 'dikembalikan') {
            return back();
        }

        DB::transaction(function () use ($borrowing, $request) {
            $returnDate = \Carbon\Carbon::parse($borrowing->return_date)->startOfDay();
            $now = now()->startOfDay();

            $fine = 0;
            // Check if overdue
            if ($now->gt($returnDate)) {
                $daysLate = $now->diffInDays($returnDate);
                // Fetch fine rate, ensuring integer
                $finePerDay = (int) (\App\Models\Setting::where('key', 'fine_per_day')->value('value') ?? 1000);
                $fine = abs((int) ($daysLate * $finePerDay));
            }

            $status = $fine > 0 ? 'denda_belum_lunas' : 'dikembalikan';

            $borrowing->update([
                'status' => $status,
                'fine' => $fine
            ]);
            $borrowing->book->increment('stock');

            // Handle Review if Rating is provided
            if ($request->filled('rating')) {
                // Check if already reviewed to prevent duplicates from multiple clicks/requests
                $existingReview = \App\Models\Review::where('user_id', Auth::id())
                    ->where('book_id', $borrowing->book_id)
                    ->exists();

                if (!$existingReview) {
                    \App\Models\Review::create([
                        'user_id' => Auth::id(),
                        'book_id' => $borrowing->book_id,
                        'rating' => $request->rating,
                        'comment' => $request->comment,
                    ]);
                }
            }
        });

        $borrowing->refresh();

        $message = 'Buku Dikembalikan.';
        if ($borrowing->fine > 0) {
            $message .= ' Harap lunasi denda sebesar Rp ' . number_format($borrowing->fine, 0, ',', '.') . ' agar status menjadi Lunas.';
        }

        return back()->with('success', $message);
    }

    public function markAsPaid($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status !== 'denda_belum_lunas') {
            return back()->with('error', 'Transaksi ini tidak memiliki tagihan tertunda.');
        }

        $borrowing->update(['status' => 'dikembalikan']);

        return back()->with('success', 'Denda telah ditandai LUNAS.');
    }

    // Admin Section
    public function adminDashboard(Request $request)
    {
        $limit = $request->input('limit', 5);

        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalBorrowings = Borrowing::count();

        $latestTransactions = Borrowing::with(['user', 'book'])->latest()->take($limit)->get();
        $latestUsers = User::where('role', 'user')->latest()->take($limit)->get();
        $latestBooks = Book::with('category')->latest()->take($limit)->get();
        $latestCategories = \App\Models\Category::withCount('books')->latest()->take($limit)->get();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'totalBorrowings', 'latestTransactions', 'latestUsers', 'latestBooks', 'latestCategories', 'limit'));
    }

    public function transactions()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        $finePerDay = (int) (\App\Models\Setting::where('key', 'fine_per_day')->value('value') ?? 1000);
        return view('admin.transactions', compact('borrowings', 'finePerDay'));
    }

    public function export(Request $request)
    {
        $filename = "laporan-transaksi-" . date('Y-m-d-H-i-s') . ".csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Peminjam', 'Buku', 'Tanggal Pinjam', 'Batas Kembali', 'Status', 'Denda'];

        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();

        $callback = function () use ($borrowings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($borrowings as $b) {
                fputcsv($file, [
                    $b->id,
                    optional($b->user)->name ?? 'User Terhapus',
                    optional($b->book)->title ?? 'Buku Terhapus',
                    $b->borrow_date,
                    $b->return_date,
                    ucfirst(str_replace('_', ' ', $b->status)),
                    $b->fine ?? 0
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function print(Request $request)
    {
        $start_date = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end_date = $request->end_date ?? now()->toDateString();

        $borrowings = Borrowing::with(['user', 'book'])
            ->whereDate('borrow_date', '>=', $start_date)
            ->whereDate('borrow_date', '<=', $end_date)
            ->get();

        return view('admin.reports.print', compact('borrowings', 'start_date', 'end_date'));
    }
}
