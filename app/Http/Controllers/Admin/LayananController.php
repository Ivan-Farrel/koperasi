<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk handle hapus gambar

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->paginate(10);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        // Sesuaikan dengan name="judul" di form kamu
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('layanan', 'public');
        }

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        // 1. Validasi harus pakai 'judul' sesuai form Blade kamu
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update manual supaya tidak salah kolom
    $layanan->update([
        'nama_layanan' => $request->judul, // Masukkan input 'judul' ke kolom 'nama_layanan'
        'deskripsi' => $request->deskripsi,
    ]);

        $data = $request->all();

        // 2. Logika Update Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada di storage agar tidak menumpuk
            if ($layanan->image) {
                Storage::delete('public/' . $layanan->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('layanan', 'public');
        }

        // 3. Eksekusi Update
        $layanan->update($data);

        // 4. Redirect kembali ke Dashboard (admin.dashboard) agar tidak 404
        return redirect()->route('admin.dashboard')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy(Layanan $layanan)
    {
        // Hapus gambar dari folder storage saat data dihapus
        if ($layanan->image) {
            Storage::delete('public/' . $layanan->image);
        }
        
        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus');
    }
}