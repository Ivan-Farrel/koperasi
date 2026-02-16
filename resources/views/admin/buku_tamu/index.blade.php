@extends('admin.layout-nosidebar')

@section('title', 'Data Buku Tamu')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                📋
            </div>
            <div>
                <h2 class="text-2xl font-bold">Data Buku Tamu</h2>
                <p class="text-sm text-gray-500">Daftar pengunjung yang telah mengisi buku tamu</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                ⬅️ Kembali ke Dashboard
            </a>

            <a href="{{ route('admin.buku_tamu.export', request()->query()) }}"
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                📥 Export Excel
            </a>
        </div>
    </div>

    {{-- FILTER CARD --}}
    <form method="GET" action="{{ route('admin.buku_tamu.index') }}" class="mb-6">
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">

                {{-- Search --}}
                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-gray-600">Cari</label>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari nama / layanan..."
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Filter Layanan --}}
                <div>
                    <label class="text-sm font-medium text-gray-600">Layanan</label>
                    <select name="layanan" class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}" {{ request('layanan') == $layanan->id ? 'selected' : '' }}>
                                {{ $layanan->nama_layanan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dari Tanggal --}}
                <div>
                    <label class="text-sm font-medium text-gray-600">Dari</label>
                    <input type="date" name="from" value="{{ request('from') }}"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Sampai Tanggal --}}
                <div>
                    <label class="text-sm font-medium text-gray-600">Sampai</label>
                    <input type="date" name="to" value="{{ request('to') }}"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Tombol --}}
                <div class="flex gap-2">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center justify-center gap-2">
                        🔍 Cari
                    </button>
                    <a href="{{ route('admin.buku_tamu.index') }}"
                        class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-center">
                        Reset
                    </a>
                </div>

            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Kecamatan</th>
                    <th class="p-4 text-left">Kelurahan</th>
                    <th class="p-4 text-left">Layanan</th>
                    <th class="p-4 text-left">No. HP</th>
                    <th class="p-4 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengunjung as $item)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-4 font-medium text-gray-800">{{ $item->nama }}</td>
                        <td class="p-4 text-gray-600">{{ $item->kecamatan }}</td>
                        <td class="p-4 text-gray-600">{{ $item->kelurahan }}</td>
                        <td class="p-4">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $item->layanan->nama_layanan ?? '-' }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-600">{{ $item->no_hp }}</td>
                        <td class="p-4 text-sm text-gray-500">
                            {{ $item->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">
                            Belum ada data pengunjung.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $pengunjung->links() }}
    </div>

</div>
@endsection
