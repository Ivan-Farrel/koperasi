<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // masukin data
        $request->validate([
            'nama_layanan' => 'required', 
            'deskripsi'    => 'required',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $data = $request->only(['nama_layanan', 'deskripsi']);

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
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ini data update broooo
        $data = [
            'nama_layanan' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('image')) {
            if ($layanan->image) {
                Storage::delete('public/' . $layanan->image);
            }
            $data['image'] = $request->file('image')->store('layanan', 'public');
        }

        $layanan->update($data);

        // biar rapi
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->image) {
            Storage::delete('public/' . $layanan->image);
        }
        
        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus');
    }
}