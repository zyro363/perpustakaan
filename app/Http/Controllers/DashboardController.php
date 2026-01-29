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
        $query = Book::query();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $books = $query->get();
        return view('user.dashboard', compact('books'));
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
            $borrowing->update(['status' => 'dikembalikan']);
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
}
