<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    // Izinkan input data ke kolom ini
    protected $fillable = ['invitation_id', 'nama', 'kehadiran', 'ucapan'];
}