<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'email'  => 'required|email',
            'phone'  => 'required|string|max:20',
            'pesan'  => 'required|string|min:10',
        ]);

        // Simpan atau kirim pesan (bisa tambahkan Mail atau simpan ke DB)
        // Contoh: \Mail::to('joko@gmail.com')->send(new \App\Mail\PesanMasuk($request->all()));

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}