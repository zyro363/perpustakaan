<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::updateOrCreate(['key' => 'loan_duration'], ['value' => '7']);
        \App\Models\Setting::updateOrCreate(['key' => 'fine_per_day'], ['value' => '1000']);
        \App\Models\Setting::updateOrCreate(['key' => 'additional_terms'], ['value' => "Buku yang hilang atau rusak wajib diganti.\nJaga kebersihan buku."]);
    }
}
