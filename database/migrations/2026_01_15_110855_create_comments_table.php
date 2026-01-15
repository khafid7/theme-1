<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        
        // PENTING: Ini penghubung ke tabel invitations
        // Jadi kita tahu ucapan ini milik siapa (Romeo atau klien lain?)
        $table->foreignId('invitation_id')->constrained('invitations')->onDelete('cascade');
        
        $table->string('nama');
        $table->string('kehadiran'); // Hadir / Tidak Hadir
        $table->text('ucapan');
        
        $table->timestamps(); // Mencatat kapan ucapan dibuat
    });
}
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
