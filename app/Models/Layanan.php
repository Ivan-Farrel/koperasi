<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // Tambahkan 'judul' dan hapus 'nama_layanan' agar sinkron dengan form
    protected $fillable = [
        'nama_layanan',      // Sesuaikan dengan name="judul" di Blade
        'deskripsi',  // Sudah sesuai
        'image'       // Sudah sesuai
    ];

    /**
     * Relasi ke Buku Tamu
     * Jika Modelnya bernama BukuTamu, pastikan penulisan class-nya benar.
     */
    public function bukuTamus()
    {
        return $this->hasMany(BukuTamu::class);
    }
}