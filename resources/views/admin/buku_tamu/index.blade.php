@extends('admin.layout')

@section('title', 'Log Buku Tamu')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary-blue: #0056b3;
        --soft-bg: #f8fafc;
    }

    body { font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Card Wrapper Utama */
    .executive-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.05);
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    /* Filter Area yang Dirapikan */
    .filter-wrapper {
        background: #fdfdfe;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
    }

    .filter-label {
        font-size: 0.7rem;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
        display: block;
    }

    .filter-input {
        width: 100%;
        padding: 12px 16px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
        color: #334155;
        transition: 0.3s;
    }

    .filter-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(0, 86, 179, 0.08);
        outline: none;
    }

    /* Table Design */
    .table-container {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }
    .custom-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        padding: 20px;
        border-bottom: 2px solid #f1f5f9;
    }
    .custom-table tbody td {
        padding: 18px 20px;
        font-size: 0.9rem;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Buttons */
    .btn-action {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.875rem;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary-custom { background: var(--primary-blue); color: white; }
    .btn-primary-custom:hover { background: #004494; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,86,179,0.2); }

    .btn-export { background: #10b981; color: white; }
    .btn-export:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2); }
</style>

<div class="animate__animated animate__fadeIn">
    <div class="executive-card">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-sm">
                    <i class="bi bi-person-badge-fill fs-3"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Log Pengunjung</h2>
                    <p class="text-slate-400 text-sm font-medium">Monitoring aktivitas buku tamu secara komprehensif.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.buku_tamu.export', request()->query()) }}" class="btn-action btn-export shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i> Export Excel
                </a>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.buku_tamu.index') }}">
            <div class="filter-wrapper shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    
                    <div class="md:col-span-4">
                        <label class="filter-label">Pencarian Cepat</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau layanan..." class="filter-input">
                    </div>

                    <div class="md:col-span-2">
                        <label class="filter-label">Kategori Layanan</label>
                        <select name="layanan" class="filter-input">
                            <option value="">Semua Layanan</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}" {{ request('layanan') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="filter-label">Dari Tanggal</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="filter-input">
                    </div>

                    <div class="md:col-span-2">
                        <label class="filter-label">Sampai Tanggal</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="filter-input">
                    </div>

                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit" class="btn-action btn-primary-custom flex-grow justify-center">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('admin.buku_tamu.index') }}" class="btn-action bg-slate-100 text-slate-500 hover:bg-slate-200">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>

                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="w-full custom-table">
                <thead>
                    <tr>
                        <th>Identitas Tamu</th>
                        <th>Wilayah Admin</th>
                        <th>Layanan Dituju</th>
                        <th>Waktu & Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengunjung as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td>
                                <div class="font-extrabold text-slate-800">{{ $item->nama }}</div>
                                <div class="flex items-center text-xs text-green-600 font-bold mt-1">
                                    <i class="bi bi-whatsapp me-1"></i> {{ $item->no_hp }}
                                </div>
                            </td>
                            <td>
                                <div class="font-semibold text-slate-700">{{ $item->kecamatan }}</div>
                                <div class="text-xs text-slate-400">{{ $item->kelurahan }}</div>
                            </td>
                            <td>
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold border border-blue-100">
                                    {{ $item->layanan->nama_layanan ?? 'Umum' }}
                                </span>
                            </td>
                            <td>
                                <div class="font-bold text-slate-700 text-sm">{{ $item->created_at->format('d M Y') }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase">{{ $item->created_at->format('H:i') }} WIB</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-16 text-center text-slate-400 font-medium">
                                <i class="bi bi-database-exclamation fs-1 d-block mb-3 opacity-20"></i>
                                Tidak ada log kunjungan untuk kriteria ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $pengunjung->links() }}
        </div>

    </div>
</div>
@endsection