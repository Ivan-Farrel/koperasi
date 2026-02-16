@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow p-6">

        <div class="mb-6">
            <h2 class="text-xl font-bold flex items-center gap-2">
                ➕ Tambah Layanan
            </h2>
            <p class="text-sm text-gray-500">
                Isi data layanan yang akan ditampilkan di website.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.layanan.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Nama Layanan</label>
                <input
                    type="text"
                    name="nama_layanan"
                    value="{{ old('nama_layanan') }}"
                    required
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Contoh: Pembuatan NIB"
                >
            </div>

            <div>
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Deskripsi singkat layanan..."
                >{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2"
                >
                    💾 <span>Simpan</span>
                </button>

                <a
                    href="{{ route('admin.layanan.index') }}"
                    class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 transition flex items-center gap-2"
                >
                    ↩️ <span>Batal</span>
                </a>
            </div>
        </form>

    </div>
</div>

@endsection
