@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

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

    /* Card Wrapper Modern */
    .content-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        padding: 35px;
    }

    /* Button Styling */
    .btn-add {
        background: linear-gradient(90deg, var(--primary-blue), #00d2ff);
        color: white;
        font-weight: 700;
        padding: 12px 24px;
        border-radius: 12px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-add:hover {
        box-shadow: 0 10px 20px rgba(0,210,255,0.3);
        transform: translateY(-2px);
        color: white;
    }

    /* Table Professional Styling */
    .table-container {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        margin-top: 20px;
    }
    .custom-table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.05em;
        font-weight: 800;
        color: #64748b;
        padding: 20px;
        border-bottom: 2px solid #f1f5f9;
    }
    .custom-table tbody td {
        padding: 20px;
        vertical-align: middle;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Action Icons */
    .action-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.2s;
        text-decoration: none;
    }
    .btn-edit { background: #eff6ff; color: #2563eb; }
    .btn-edit:hover { background: #2563eb; color: white; }
    
    .btn-delete { background: #fff1f2; color: #e11d48; border: none; }
    .btn-delete:hover { background: #e11d48; color: white; }

    .service-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
    }
</style>

<div class="animate__animated animate__fadeIn">
    <div class="content-card">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Data Layanan</h2>
                <p class="text-slate-400 text-sm font-medium mt-1">Kelola daftar layanan publik yang tersedia pada sistem.</p>
            </div>
            <a href="{{ route('admin.layanan.create') }}" class="btn-add shadow-sm">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Layanan Baru</span>
            </a>
        </div>

        <div class="table-container">
            <table class="w-full custom-table">
                <thead>
                    <tr class="text-left">
                        <th style="width: 25%">Nama Layanan</th>
                        <th style="width: 50%">Deskripsi Layanan</th>
                        <th class="text-center" style="width: 25%">Aksi Strategis</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td>
                                <!-- <div class="service-badge d-inline-block mb-2">Service ID: #{{ $layanan->id }}</div> -->
                                <div class="font-extrabold text-slate-800 text-base">{{ $layanan->nama_layanan }}</div>
                            </td>
                            <td>
                                <p class="text-slate-500 leading-relaxed mb-0">
                                    {{ \Illuminate\Support\Str::limit($layanan->deskripsi, 100) }}
                                </p>
                            </td>
                            <td class="text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.layanan.edit', $layanan) }}" 
                                       class="action-btn btn-edit shadow-sm" 
                                       title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('admin.layanan.destroy', $layanan) }}" 
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')"
                                                class="action-btn btn-delete shadow-sm"
                                                title="Hapus Data">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-12 text-center">
                                <i class="bi bi-folder-x text-slate-200 display-1"></i>
                                <p class="text-slate-400 font-bold mt-4">Database layanan masih kosong.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($layanans, 'links'))
            <div class="mt-8 px-2">
                {{ $layanans->links() }}
            </div>
        @endif

    </div>
</div>

@endsection