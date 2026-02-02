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
        // 1. Create Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'address' => 'Perpustakaan Central',
        ]);

        // 2. Create Sample User
        User::create([
            'name' => 'Siswa Teladan',
            'username' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'address' => 'Kelas X RPL 1',
        ]);

        // 3. Seed Settings
        $this->call(SettingSeeder::class);

        // 4. Create Books
        \App\Models\Book::create([
            'title' => 'Laskar Pelangi',
            'writer' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'year' => 2005,
            'stock' => 5,
            // Ensure we don't miss categories if they are required. 
            // Wait, categories table exists. We should create categories logic too OR nullable.
            // But for now, let's just stick to what was there, assuming category_id is nullable or has default.
            // Actually, category_id was added recently. It might be required.
            // Better to create a category and assign it.
        ]);

        // Let's create categories first to be safe
        $novel = \App\Models\Category::create(['name' => 'Novel']);
        $sejarah = \App\Models\Category::create(['name' => 'Sejarah']);

        \App\Models\Book::first()->update(['category_id' => $novel->id]);

        \App\Models\Book::create([
            'title' => 'Bumi Manusia',
            'writer' => 'Pramoedya Ananta Toer',
            'publisher' => 'Hasta Mitra',
            'year' => 1980,
            'stock' => 3,
            'category_id' => $sejarah->id
        ]);
    }
}
