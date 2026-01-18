<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();

            // --- 1. CONFIG & URL ---
            $table->string('slug')->unique(); // Link undangan
            $table->string('theme')->default('royal-glass'); 
            $table->boolean('is_active')->default(true); 

            // --- 2. MEMPELAI PRIA (GROOM) ---
            $table->string('groom_name');       // Nama Lengkap
            $table->string('groom_nickname');   // Nama Panggilan
            $table->string('groom_father');     // Nama Ayah
            $table->string('groom_mother');     // Nama Ibu
            $table->string('groom_instagram')->nullable();
            $table->string('groom_photo')->nullable(); // foto Pria

            // --- 3. MEMPELAI WANITA (BRIDE) ---
            $table->string('bride_name');       
            $table->string('bride_nickname');   
            $table->string('bride_father');
            $table->string('bride_mother');
            $table->string('bride_instagram')->nullable();
            $table->string('bride_photo')->nullable(); 

            // --- 4. ACARA 1 (AKAD) ---
            $table->string('akad_title')->default('Akad Nikah');
            $table->dateTime('akad_datetime');
            $table->string('akad_location');
            $table->text('akad_address')->nullable();
            $table->text('akad_map_link')->nullable();

            // --- 5. ACARA 2 (RESEPSI) ---
            $table->string('resepsi_title')->default('Resepsi Pernikahan');
            $table->dateTime('resepsi_datetime');
            $table->string('resepsi_location');
            $table->text('resepsi_address')->nullable();
            $table->text('resepsi_map_link')->nullable();

            // --- 6. DIGITAL GIFT (1 Bank) ---
            $table->string('bank_name')->nullable();    // Nama Bank
            $table->string('bank_number')->nullable();  // Nomor Rekening
            $table->string('bank_holder')->nullable();  // a.n Rekening
            
            // Alamat Kirim Kado Fisik
            $table->text('gift_address')->nullable(); 
            $table->text('gift_map_link')->nullable();

            // --- 7. ASSETS & CONTENT ---
            $table->string('music_file')->nullable(); 
            $table->string('cover_image')->nullable();
            $table->string('hero_image'); // Foto Home 
            $table->text('quote')->nullable(); 
            $table->json('gallery_photos')->nullable(); // Array Foto
            $table->json('love_stories')->nullable();   // Array Cerita

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};