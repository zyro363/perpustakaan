<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $books = \App\Models\Book::with('category')->latest()->take(8)->get();
        $totalBooks = \App\Models\Book::count();
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        // Fetch Settings for possible display, defaulting if not found
        $duration = \App\Models\Setting::where('key', 'loan_duration')->value('value') ?? 7;

        return view('welcome', compact('books', 'duration', 'totalBooks', 'totalUsers'));
    }
}
