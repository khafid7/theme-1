<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; // Wajib: Panggil Model Comment yang tadi kita buat

class InvitationController extends Controller
{
    // Fungsi 1: Menampilkan Halaman Undangan
    public function index()
    {
        // Ambil semua komentar, urutkan dari yang terbaru (descending)
        $comments = Comment::orderBy('created_at', 'desc')->get();
        
        // Kirim data $comments ke file tampilan (view) bernama 'undangan'
        return view('undangan', compact('comments'));
    }

    // Fungsi 2: Menyimpan Ucapan Baru
    public function store(Request $request)
    {
        // Validasi: Pastikan data tidak kosong
        $request->validate([
            'nama' => 'required',
            'kehadiran' => 'required',
            'ucapan' => 'required',
        ]);

        // Simpan ke database
        Comment::create([
            'nama' => $request->nama,
            'kehadiran' => $request->kehadiran,
            'ucapan' => $request->ucapan
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Ucapan berhasil dikirim!');
    }
}