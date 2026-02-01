<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = \App\Models\Favorite::where('user_id', Auth::id())->with('book.category')->latest()->get();
        return view('user.favorites.index', compact('favorites'));
    }

    public function toggle($bookId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $favorite = \App\Models\Favorite::where('user_id', $user->id)->where('book_id', $bookId)->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Buku dihapus dari favorit.');
        } else {
            \App\Models\Favorite::create([
                'user_id' => $user->id,
                'book_id' => $bookId
            ]);
            return back()->with('success', 'Buku ditambahkan ke favorit!');
        }
    }
}
