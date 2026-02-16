<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
    ];

    // Relasi ke Buku Tamu
    public function bukuTamus()
    {
        return $this->hasMany(BukuTamu::class);
    }
}
