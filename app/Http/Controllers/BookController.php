<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
            'stock' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $data['cover'] = $path;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully');
    }

    public function edit(Book $book)
    {
        $categories = \App\Models\Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
            'stock' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($book->cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
            }
            $path = $request->file('cover')->store('covers', 'public');
            $data['cover'] = $path;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        if ($book->cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }
}
