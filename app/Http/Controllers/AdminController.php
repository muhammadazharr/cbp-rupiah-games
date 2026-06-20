<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('Dashboard.admin_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'rupa_rupiah_timer' => 'required|integer|min:5',
            'ingat_rupiah_memorize_timer' => 'required|integer|min:3',
            'ingat_rupiah_answer_timer' => 'required|integer|min:5',
        ]);

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
