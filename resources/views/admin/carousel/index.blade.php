@extends('admin.layout') {{-- sesuaikan layout admin kamu --}}

@section('title', 'Kelola Carousel')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Kelola Carousel</h2>
    </div>

    {{-- Upload Form --}}
    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center gap-4">
                <input type="file" name="image" required class="border rounded p-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    + Tambah Carousel
                </button>
            </div>
        </form>
    </div>

    {{-- List Carousel --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($carousels as $item)
            <div class="bg-white p-4 rounded-xl shadow">
                <img src="{{ asset('storage/'.$item->image) }}" class="rounded-lg mb-3">

                <form action="{{ route('admin.carousel.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus gambar ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="w-full bg-red-600 text-white py-2 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        @endforeach
    </div>

</div>
@endsection
