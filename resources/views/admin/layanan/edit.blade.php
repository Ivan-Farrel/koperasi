@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Layanan</h2>

<form action="{{ route('admin.layanan.update', $layanan) }}" method="POST" class="bg-white p-6 rounded shadow max-w-xl">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1 font-medium">Judul</label>
        <input type="text" name="judul" value="{{ $layanan->judul }}" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea name="deskripsi" rows="4" class="w-full border rounded p-2" required>{{ $layanan->deskripsi }}</textarea>
    </div>

    <div class="flex gap-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('admin.layanan.index') }}" class="px-4 py-2 border rounded">Batal</a>
    </div>
</form>
@endsection
