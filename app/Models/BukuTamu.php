<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kecamatan',
        'kelurahan',
        'alamat',
        'no_hp',
        'layanan_id',
        'keterangan',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
