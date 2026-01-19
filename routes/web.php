<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Comment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan Server (Cuma buat cek jalan/nggak)
Route::get('/', function () {
    return "Server Undangan Berjalan! Coba buka: sesuai linknya (Contoh : /romeo-juliet)";
});

// --- 1. PROSES SIMPAN UCAPAN (Backend Utama) ---
// Ini dipakai oleh SEMUA TEMA (Royal, Rustic, Luxury)
Route::post('/kirim-ucapan', function (Request $request) {
    
    // Validasi
    $request->validate([
        'invitation_slug' => 'required',
        'nama' => 'required|max:50',
        'ucapan' => 'required',
        'kehadiran' => 'required'
    ]);

    // Cari ID Undangan
    $invitation = Invitation::where('slug', $request->invitation_slug)->firstOrFail();

    // Simpan ke Database
    Comment::create([
        'invitation_id' => $invitation->id,
        'nama' => $request->nama,
        'kehadiran' => $request->kehadiran,
        'ucapan' => $request->ucapan
    ]);
    
    return back()->with('success', 'Ucapan Anda berhasil terkirim.');
    
})->name('kirim.ucapan');


// --- 2. TAMPILKAN UNDANGAN DINAMIS (Read) ---
// Route Wildcard: Menangkap apapun slug yang diketik user
Route::get('/{slug}', function ($slug) {
    
    // Ambil data undangan + komentar dari database
    $invitation = \App\Models\Invitation::with('comments')->where('slug', $slug)->firstOrFail();

    if (!$invitation->is_active) {
        abort(404, 'Undangan tidak aktif.');
    }

    // LOGIC AJAIB PEMILIH TEMA
    // Kalau di DB theme='luxury-gold', dia otomatis buka: themes/luxury-gold/index.blade.php
    $viewPath = 'themes.' . $invitation->theme . '.index';

    // Cek error kalau folder tema belum dibuat
    if (!view()->exists($viewPath)) {
        return "ERROR: Tema '" . $invitation->theme . "' belum dibuat file view-nya! Cek nama folder di resources/views/themes.";
    }

    // Tampilkan Tema yang sesuai
    return view($viewPath, ['invitation' => $invitation]);
    
})->name('invitation.show');