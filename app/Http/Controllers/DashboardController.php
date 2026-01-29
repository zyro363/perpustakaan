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

        return view('user.dashboard', compact('books', 'categories'));
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
                'return_date' => now()->addDays(7),
                'status' => 'dipinjam'
            ]);

            $book->decrement('stock');
        });

        return back()->with('success', 'Buku Dipinjam');
    }

    public function borrowings()
    {
        $borrowings = Auth::user()->borrowings()->with('book')->get();
        return view('user.borrowings', compact('borrowings'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        // Ensure user owns this borrowing
        if ($borrowing->user_id !== Auth::id()) {
            abort(403);
        }

        if ($borrowing->status === 'dikembalikan') {
            return back();
        }

        DB::transaction(function () use ($borrowing) {
            $returnDate = \Carbon\Carbon::parse($borrowing->return_date);
            $now = now();

            $fine = 0;
            if ($now->gt($returnDate)) {
                $daysLate = $now->diffInDays($returnDate);
                $fine = $daysLate * 1000;
            }

            $borrowing->update([
                'status' => 'dikembalikan',
                'fine' => $fine
            ]);
            $borrowing->book->increment('stock');
        });

        return back()->with('success', 'Buku Dikembalikan');
    }

    // Admin Section
    public function adminDashboard()
    {
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalBorrowings = Borrowing::count();
        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'totalBorrowings'));
    }

    public function transactions()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('admin.transactions', compact('borrowings'));
    }

    public function print(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $borrowings = Borrowing::with(['user', 'book'])
            ->whereBetween('borrow_date', [$start_date, $end_date])
            ->get();

        return view('admin.reports.print', compact('borrowings', 'start_date', 'end_date'));
    }
}
