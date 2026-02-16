@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- TOTAL LAYANAN --}}
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Layanan</p>
                <p class="text-3xl font-bold mt-1">{{ \App\Models\Layanan::count() }}</p>
            </div>
            <div class="text-3xl">🗂️</div>
        </div>
    </div>

    {{-- TOTAL BUKU TAMU --}}
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pengunjung Hari Ini</p>
                <p class="text-3xl font-bold mt-1">
                    {{ \App\Models\BukuTamu::count() ?? 0 }}
                </p>
            </div>
            <div class="text-3xl">📝</div>
        </div>
    </div>

    {{-- STATUS --}}
    <div class="bg-white rounded-xl p-6 shadow flex justify-between items-center">
        <div>
            <p class="text-gray-500 text-sm">Status Sistem</p>
            <p class="text-3xl font-bold mt-2 {{ $status === 'aktif' ? 'text-green-600' : 'text-red-600' }}">
                {{ ucfirst($status) }}
            </p>
        </div>

        <form action="{{ route('admin.dashboard.toggleStatus') }}" method="POST">
            @csrf
            <button type="submit"
                class="px-4 py-2 rounded-lg text-white {{ $status === 'aktif' ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                {{ $status === 'aktif' ? 'Set Istirahat' : 'Set Aktif' }}
            </button>
        </form>
    </div>

</div>

{{-- WELCOME CARD --}}
<div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-2xl p-8 shadow">
    <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name ?? 'Admin' }} 👋</h2>
    <p class="text-blue-100">
        Selamat bekerja di Sistem Buku Tamu Digital  
        Dinas Koperasi, Usaha Mikro, dan Ketenagakerjaan Kota Kediri.
    </p>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('admin.layanan.index') }}"
           class="bg-white text-blue-600 px-5 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
            Kelola Layanan
        </a>
        <a href="{{ route('admin.buku_tamu.index') }}"
        class="border border-white text-white px-5 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
            Lihat Buku Tamu
        </a>
    </div>
</div>

{{-- TABEL PENGUNJUNG TERBARU --}}
<div class="mt-8 bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-4">📝 Pengunjung Terbaru</h3>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kecamatan</th>
                    <th class="p-3">Kelurahan</th>
                    <th class="p-3">Layanan</th>
                    <th class="p-3">No. HP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengunjung as $item)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $item->nama }}</td>
                        <td class="p-3">{{ $item->kecamatan }}</td>
                        <td class="p-3">{{ $item->kelurahan }}</td>
                        <td class="p-3">
                            {{ $item->layanan->nama_layanan ?? '-' }}
                        </td>
                        <td class="p-3">{{ $item->no_hp }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">
                            Belum ada data pengunjung.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
