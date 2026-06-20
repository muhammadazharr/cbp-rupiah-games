<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemain;

class IngatRupiahController extends Controller
{
    public function index($user_id)
    {
        return view('IngatRupiah.index', compact('user_id'));
    }

    public function question($user_id)
    {
        $memorizeTimer = \App\Models\Setting::where('key', 'ingat_rupiah_memorize_timer')->first()->value ?? 8;
        $answerTimer = \App\Models\Setting::where('key', 'ingat_rupiah_answer_timer')->first()->value ?? 18;
        return view('IngatRupiah.question', compact('user_id', 'memorizeTimer', 'answerTimer'));
    }

    public function result($user_id, $points)
    {
        $pemain = Pemain::findOrFail($user_id);
        $pemain->update([
            'game' => 'Ingat Rupiah',
            'skor' => $points,
        ]);
        $hasil = ($points / 8) * 100;
        $affirmation = 'Anda Belum Beruntung ';
        $poin = '0 Poin';
         if ($hasil >= 0 && $hasil < 70) {
            $affirmation = 'Selamat Anda Mendapatkan ';
            $poin = '1 Poin';
        } elseif ($hasil >= 70 && $hasil < 100) {
            $affirmation = 'Selamat Anda Mendapatkan ';
            $poin = '2 Poin';
        } elseif ($hasil >= 100) {
            $affirmation = 'Selamat Anda Mendapatkan ';
            $poin = '3 Poin';
        }
        return view('IngatRupiah.result', compact('hasil', 'poin', 'affirmation'));
    }
}
