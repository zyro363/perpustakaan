<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $book = \App\Models\Book::findOrFail($bookId);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Optional: Check if user has borrowed the book
        $hasBorrowed = \App\Models\Borrowing::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->where('status', 'dikembalikan') // Only allow if returned (meaning they read it)
            ->exists();

        // For now, let's strictly require them to have returned the book to review it
        // If you want looser rules (e.g. active borrowing), change this logic.
        if (!$hasBorrowed) {
            // Uncomment below to restrict
            // return back()->with('error', 'Anda harus meminjam dan mengembalikan buku ini sebelum memberikan review.');
        }

        // Check if already reviewed
        $existingReview = \App\Models\Review::where('user_id', $user->id)->where('book_id', $bookId)->first();
        if ($existingReview) {
            return back()->with('error', 'Anda sudah mereview buku ini.');
        }

        \App\Models\Review::create([
            'user_id' => $user->id,
            'book_id' => $bookId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review berhasil dikirim! Terima kasih atas ulasan Anda.');
    }
}
