<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'akad_datetime' => 'datetime',
        'resepsi_datetime' => 'datetime',
        'gallery_photos' => 'array',
        'love_stories' => 'array',
    ];
    // Relasi: Satu Undangan memiliki Banyak Komentar
    public function comments()
    {
        // Urutkan dari yang terbaru (latest)
        return $this->hasMany(Comment::class)->latest();
    }
}