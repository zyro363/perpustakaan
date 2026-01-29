<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::withCount('books')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name']);
        \App\Models\Category::create($request->all());
        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, \App\Models\Category $category)
    {
        $request->validate(['name' => 'required|unique:categories,name,' . $category->id]);
        $category->update($request->all());
        return back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(\App\Models\Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
