@extends('layouts.admin')

@section('title', 'Data Layanan')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">🗂️ Data Layanan</h2>
        <a href="{{ route('admin.layanan.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
            ➕ <span>Tambah Layanan</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-3">Nama Layanan</th>
                    <th class="p-3">Deskripsi</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $layanan)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 font-medium">
                            {{ $layanan->nama_layanan }}
                        </td>
                        <td class="p-3 text-gray-600">
                            {{ \Illuminate\Support\Str::limit($layanan->deskripsi, 80) }}
                        </td>
                        <td class="p-3 text-center space-x-3">
                            <a href="{{ route('admin.layanan.edit', $layanan) }}"
                               class="text-blue-600 hover:underline">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('admin.layanan.destroy', $layanan) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus layanan ini?')"
                                        class="text-red-600 hover:underline">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-500">
                            Belum ada data layanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION (kalau pakai paginate()) --}}
    @if(method_exists($layanans, 'links'))
        <div class="mt-4">
            {{ $layanans->links() }}
        </div>
    @endif

</div>

@endsection
