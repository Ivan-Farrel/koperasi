<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    // Munculkan Halaman Manajemen Banner
    public function index()
    {
        $carousels = Carousel::latest()->get();
        return view('admin.carousel.index', compact('carousels'));
    }

    // Simpan Gambar Baru ke Storage
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('carousels', 'public');

            Carousel::create([
                'title' => $request->title,
                'image' => $path,
                'is_active' => true
            ]);

            return back()->with('success', 'Banner baru berhasil diupload!');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }

    // Hapus Banner
    public function destroy(Carousel $carousel)
    {
        // Hapus file fisiknya di folder storage
        if ($carousel->image) {
            Storage::disk('public')->delete($carousel->image);
        }
        
        $carousel->delete();

        return back()->with('success', 'Banner berhasil dihapus!');
    }
}