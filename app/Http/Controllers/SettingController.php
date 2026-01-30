<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $duration = Setting::where('key', 'loan_duration')->value('value') ?? 7;
        $fine = Setting::where('key', 'fine_per_day')->value('value') ?? 1000;
        $terms = Setting::where('key', 'additional_terms')->value('value') ?? "Buku yang hilang atau rusak wajib diganti.";

        return view('admin.settings.index', compact('duration', 'fine', 'terms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'loan_duration' => 'required|numeric|min:1',
            'fine_per_day' => 'required|numeric|min:0',
            'additional_terms' => 'nullable|string',
        ]);

        Setting::updateOrCreate(['key' => 'loan_duration'], ['value' => $request->loan_duration]);
        Setting::updateOrCreate(['key' => 'fine_per_day'], ['value' => $request->fine_per_day]);
        Setting::updateOrCreate(['key' => 'additional_terms'], ['value' => $request->additional_terms]);

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
