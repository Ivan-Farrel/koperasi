<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use App\Models\Layanan;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    // =========================
    // FORM BUKU TAMU (PENGUNJUNG)
    // =========================
    public function create()
    {
        $layanans = Layanan::orderBy('nama_layanan')->get();
        return view('buku_tamu.create', compact('layanans'));
    }

    // =========================
    // SIMPAN DATA BUKU TAMU
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|string|max:20',
            'layanan_id' => 'required|exists:layanans,id',
            'keterangan' => 'nullable|string',
        ]);

        BukuTamu::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih, data Anda sudah tersimpan.');
    }

    // =========================
    // ADMIN: LIHAT DATA BUKU TAMU
    // =========================
    public function index()
    {
        $pengunjung = BukuTamu::with('layanan')
            ->latest()
            ->paginate(10);

        return view('admin.buku_tamu.index', compact('pengunjung'));
    }
}
