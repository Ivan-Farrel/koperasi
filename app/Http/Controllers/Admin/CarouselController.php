<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::latest()->get();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('carousel', 'public');

        Carousel::create([
            'image' => $path,
            'is_active' => true,
        ]);

        return back()->with('success', 'Carousel berhasil ditambahkan');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete($carousel->image);
        $carousel->delete();

        return back()->with('success', 'Carousel berhasil dihapus');
    }
}

