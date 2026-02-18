@extends('layouts.admin')

@section('title', 'Executive Dashboard')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary-blue: #0056b3;
        --soft-bg: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Card Stat Modern ala Startup */
    .stat-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.04);
    }

    .icon-shape {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
    }

    /* Executive Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #003060, #0056b3);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
    }

    /* Professional Table Styling */
    .table-container {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .custom-table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: #64748b;
        padding: 18px;
    }
    .custom-table tbody td {
        padding: 18px;
        vertical-align: middle;
        color: #334155;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
    }
</style>

<div class="animate__animated animate__fadeIn">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        {{-- CARD: TOTAL LAYANAN --}}
        <div class="stat-card p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500 mb-1">Total Layanan</p>
                    <h3 class="text-3xl font-extrabold text-slate-800">{{ \App\Models\Layanan::count() }}</h3>
                </div>
                <div class="icon-shape bg-blue-50 text-blue-600">
                    <i class="bi bi-layers-fill fs-3"></i>
                </div>
            </div>
        </div>

        {{-- CARD: TOTAL BUKU TAMU HARI INI --}}
        <div class="stat-card p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500 mb-1">Pengunjung Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-slate-800">{{ \App\Models\BukuTamu::count() ?? 0 }}</h3>
                </div>
                <div class="icon-shape bg-indigo-50 text-indigo-600">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
            </div>
        </div>

        {{-- CARD: STATUS SISTEM --}}
        <div class="stat-card p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Service Status</p>
                    <div class="flex items-center mt-2">
                        <span class="status-badge {{ $status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            ● {{ ucfirst($status) }}
                        </span>
                    </div>
                </div>
                <form action="{{ route('admin.dashboard.toggleStatus') }}" method="POST">
                    @csrf
                    <button type="submit" 
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm
                        {{ $status === 'aktif' ? 'bg-slate-800 text-white hover:bg-slate-900' : 'bg-green-600 text-white hover:bg-green-700' }}">
                        {{ $status === 'aktif' ? 'SET BREAK' : 'SET ACTIVE' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="welcome-banner p-10 text-white mb-8 shadow-xl animate__animated animate__zoomIn">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold mb-3">Executive Workspace</h2>
                <p class="text-blue-100 text-lg opacity-90 max-w-2xl">
                    Selamat datang kembali, <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>. 
                    Pantau produktivitas dan log kunjungan DINKOP UMTK Kota Kediri hari ini.
                </p>
            </div>
            <div class="flex gap-4 relative z-10">
                <a href="{{ route('admin.layanan.index') }}" 
                   class="bg-white/10 backdrop-blur-md border border-white/20 px-6 py-3 rounded-xl font-bold hover:bg-white hover:text-blue-700 transition-all text-sm">
                   Manage Services
                </a>
                <a href="{{ route('admin.buku_tamu.index') }}" 
                   class="bg-white text-blue-700 px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-white/20 transition-all text-sm">
                   View Visit Logs
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white stat-card p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-extrabold text-slate-800">
                <i class="bi bi-journal-text me-2 text-blue-600"></i> Log Pengunjung Terbaru
            </h3>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Real-time Activity</span>
        </div>

        <div class="table-container">
            <table class="w-full custom-table">
                <thead>
                    <tr>
                        <th>Identitas</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Layanan</th>
                        <th>Nomor HP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengunjung as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td>
                                <div class="font-bold text-slate-800">{{ $item->nama }}</div>
                                <div class="text-[10px] text-slate-400">Recorded at: {{ $item->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="text-sm font-medium text-slate-600">{{ $item->kecamatan }}</td>
                            <td class="text-sm font-medium text-slate-600">{{ $item->kelurahan }}</td>
                            <td>
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold border border-blue-100">
                                    {{ $item->layanan->nama_layanan ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="flex items-center text-slate-600 font-medium">
                                    <i class="bi bi-whatsapp text-green-500 me-2"></i> {{ $item->no_hp }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center">
                                <i class="bi bi-inbox text-slate-200 display-4 mb-3"></i>
                                <p class="text-slate-400 font-medium mt-3">Belum ada data pengunjung yang terekam hari ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection