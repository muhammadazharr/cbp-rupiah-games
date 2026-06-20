<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemain;

class StartController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function inputBio() {
        return view('inputBio');
    }

    public function input(Request $request) {
        $pemain = Pemain::create([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ]);

        return redirect()->route('tutorial', $pemain->id);
    }

    public function tutorial($user_id)
    {
        return view('tutorial', compact('user_id'));
    }

    public function choose($user_id)
    {
        return view('choose', compact('user_id'));
    }
}
