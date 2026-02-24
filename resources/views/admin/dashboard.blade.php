@extends('admin.layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-8 animate__animated animate__fadeIn space-y-8">

    {{-- Stats Grid: Pakai Tailwind --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- CARD: TOTAL LAYANAN --}}
        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Layanan</p>
                    <h3 class="text-3xl font-black text-slate-800">{{ \App\Models\Layanan::count() }}</h3>
                </div>
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-layers-fill"></i>
                </div>
            </div>
        </div>

        {{-- CARD: PENGUNJUNG --}}
        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pengunjung Hari Ini</p>
                    <h3 class="text-3xl font-black text-slate-800">{{ \App\Models\BukuTamu::count() ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>

        {{-- CARD: STATUS --}}
        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Service Status</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            <span class="w-2 h-2 rounded-full mr-2 {{ $status === 'aktif' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            {{ strtoupper($status) }}
                        </span>
                    </div>
                </div>
                <form action="{{ route('admin.dashboard.toggleStatus') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-[10px] font-black hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                        {{ $status === 'aktif' ? 'SET BREAK' : 'SET ACTIVE' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Executive Welcome Banner --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-[#003060] to-[#0056b3] p-10 rounded-[32px] shadow-2xl shadow-blue-100">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="max-w-xl text-center md:text-left">
                <h2 class="text-4xl font-black text-white mb-4 tracking-tight">Executive Admin</h2>
                <p class="text-blue-100 text-lg font-medium opacity-90 leading-relaxed">
                    Selamat datang kembali, <span class="text-white border-b-2 border-blue-400">{{ auth()->user()->name ?? 'Administrator' }}</span>. Pantau produktivitas log kunjungan hari ini.
                </p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.layanan.index') }}" class="bg-white/10 backdrop-blur-xl border border-white/20 px-8 py-4 rounded-2xl font-bold text-white hover:bg-white hover:text-blue-900 transition-all duration-300 text-sm">
                    Kelola Layanan
                </a>
                <a href="{{ route('admin.buku_tamu.index') }}" class="bg-white px-8 py-4 rounded-2xl font-bold text-blue-700 shadow-xl hover:scale-105 transition-all duration-300 text-sm">
                    Lihat Logs
                </a>
            </div>
        </div>
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    {{-- Log Table --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-black text-slate-800 tracking-tight">
                <i class="bi bi-journal-text mr-3 text-blue-600"></i> Log Pengunjung Terbaru
            </h3>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50 px-4 py-2 rounded-full">Real-time Activity</span>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-50">
            <table class="w-full text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Identitas</th>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Wilayah</th>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Layanan</th>
                        <th class="p-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Kontak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pengunjung as $item)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="p-5">
                            <div class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $item->nama }}</div>
                            <div class="text-[10px] font-medium text-slate-400 uppercase mt-1">{{ $item->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="p-5">
                            <div class="text-sm font-bold text-slate-600">{{ $item->kecamatan }}</div>
                            <div class="text-xs text-slate-400">{{ $item->kelurahan }}</div>
                        </td>
                        <td class="p-5">
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-xl text-[10px] font-black border border-blue-100 inline-block">
                                {{ $item->layanan->nama_layanan ?? '-' }}
                            </span>
                        </td>
                        <td class="p-5 text-right">
                            <div class="inline-flex items-center text-sm font-bold text-slate-700 bg-green-50 px-4 py-2 rounded-xl border border-green-100">
                                <i class="bi bi-whatsapp text-green-500 mr-2"></i> {{ $item->no_hp }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-20 text-center">
                            <div class="text-slate-300 text-5xl mb-4"><i class="bi bi-inbox"></i></div>
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">No entries found for today</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection