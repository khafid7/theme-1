<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Invitation; // Jangan lupa ini
use App\Models\Comment;    // Dan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return "Server Undangan Berjalan! Silakan buka: /romeo-juliet";
});

// --- 1. PROSES SIMPAN UCAPAN (Create) ---
Route::post('/kirim-ucapan', function (Request $request) {
    
    // Validasi input biar aman
    $request->validate([
        'invitation_slug' => 'required',
        'nama' => 'required|max:50',
        'ucapan' => 'required',
        'kehadiran' => 'required'
    ]);

    // 1. Cari Undangan berdasarkan Slug (yang dikirim dari hidden input form)
    $invitation = Invitation::where('slug', $request->invitation_slug)->firstOrFail();

    // 2. Simpan Komentar ke Database
    Comment::create([
        'invitation_id' => $invitation->id, // Sambungkan ID-nya
        'nama' => $request->nama,
        'kehadiran' => $request->kehadiran,
        'ucapan' => $request->ucapan
    ]);
    
    // 3. Balikin ke halaman tadi dengan pesan sukses
    return back()->with('success', 'Ucapan Anda berhasil terkirim.');
    
})->name('kirim.ucapan');


// --- 2. TAMPILKAN UNDANGAN + KOMENTAR (Read) ---
Route::get('/{slug}', function ($slug) {
    
    // Ambil data undangan BESERTA komentar-komentarnya
    // 'with' digunakan agar loading database lebih cepat (Eager Loading)
    $invitation = Invitation::with('comments')->where('slug', $slug)->firstOrFail();

    if (!$invitation->is_active) {
        abort(404, 'Undangan tidak aktif.');
    }

    return view('undangan', ['invitation' => $invitation]);
    
})->name('invitation.show');