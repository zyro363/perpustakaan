<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // One Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'address' => 'Perpustakaan Central',
        ]);

        // Two Books
        \App\Models\Book::create([
            'title' => 'Laskar Pelangi',
            'writer' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'year' => 2005,
            'stock' => 5,
        ]);

        \App\Models\Book::create([
            'title' => 'Bumi Manusia',
            'writer' => 'Pramoedya Ananta Toer',
            'publisher' => 'Hasta Mitra',
            'year' => 1980,
            'stock' => 3,
        ]);
    }
}
