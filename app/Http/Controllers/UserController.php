<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%')
                    ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // Prevent editing admins via this route for safety, or just allow it but be careful.
        // For now, let's limit to users.
        if ($user->role !== 'user') {
            return back()->with('error', 'Tidak dapat mengedit akun Admin melalui menu ini.');
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'user') {
            abort(403);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nis' => 'nullable|string',
            'address' => 'nullable|string',
        ];

        // Only validate password if it's being changed
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:4';
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'user') {
            return back()->with('error', 'Tidak dapat menghapus akun Admin.');
        }

        // Optional: Check if user has active borrowings before deleting
        if ($user->borrowings()->where('status', 'dipinjam')->count() > 0) {
            return back()->with('error', 'Anggota ini masih memiliki buku yang dipinjam.');
        }

        $user->delete();

        return back()->with('success', 'Anggota berhasil dihapus');
    }
}
