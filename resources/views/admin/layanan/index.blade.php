@extends('admin.layout')

@section('content')
{{-- Area Konten: Full Tailwind agar sinkron dengan Sidebar --}}
<div class="p-8 animate__animated animate__fadeIn space-y-8">
    
    {{-- Header Page --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Manajemen Layanan</h2>
            <p class="text-sm font-bold text-slate-400 mt-1 uppercase tracking-widest">Daftar layanan publik Dinas Koperasi & UMTK</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
            <i class="bi bi-plus-lg text-lg"></i>
            Tambah Layanan Baru
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-100 p-4 rounded-2xl flex items-center gap-3 animate__animated animate__lightSpeedInLeft">
        <i class="bi bi-check-circle-fill text-green-500"></i>
        <span class="text-sm font-bold text-green-700">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 p-8">
        <div class="overflow-x-auto rounded-2xl border border-gray-50">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Layanan</th>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Deskripsi</th>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($layanans as $layanan)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="p-5">
                            <div class="flex items-center gap-4">
                                {{-- Icon Box --}}
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-black">
                                    {{ strtoupper(substr($layanan->nama_layanan ?? 'L', 0, 1)) }}
                                </div>
                                <div>
                                    {{-- NAMA LAYANAN --}}
                                    <div class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">
                                        {{ $layanan->nama_layanan }}
                                    </div>
                                    {{-- ID DATABASE (Dibuat sangat kecil agar tidak mengganggu) --}}
                                    <!-- <div class="text-[9px] font-bold text-slate-300 uppercase mt-0.5">Ref ID: #{{ $layanan->id }}</div> -->
                                </div>
                            </div>
                        </td>
                        <td class="p-5">
                            <p class="text-sm text-slate-500 leading-relaxed max-w-md">
                                {{ \Illuminate\Support\Str::limit($layanan->deskripsi, 80) }}
                            </p>
                        </td>
                        <td class="p-5">
                            <div class="flex justify-center gap-2">
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.layanan.edit', $layanan) }}" 
                                   class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm shadow-blue-100">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('admin.layanan.destroy', $layanan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')"
                                            class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm shadow-red-100">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-20 text-center">
                            <div class="flex flex-col items-center">
                                <i class="bi bi-folder-x text-slate-200 text-5xl mb-4"></i>
                                <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Database layanan masih kosong</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($layanans, 'links'))
            <div class="mt-8">
                {{ $layanans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection