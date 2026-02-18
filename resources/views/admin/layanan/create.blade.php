@extends('layouts.admin')

@section('title', 'Tambah Layanan Baru')

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
        padding: 40px;
    }

    /* Input Styling Professional */
    .form-label-custom {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        color: #4b5563;
        margin-bottom: 8px;
        margin-left: 4px;
    }

    .custom-input {
        width: 100%;
        padding: 14px 18px;
        background-color: #f1f4f9;
        border: 2px solid transparent;
        border-radius: 15px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #1e293b;
    }

    .custom-input:focus {
        background-color: #fff;
        border-color: var(--primary-blue);
        box-shadow: 0 10px 25px rgba(0,86,179,0.08);
        outline: none;
    }

    /* Button Styling */
    .btn-save {
        background: linear-gradient(90deg, var(--primary-blue), #00d2ff);
        color: white;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: 12px;
        border: none;
        transition: 0.3s;
        cursor: pointer;
    }

    .btn-save:hover {
        box-shadow: 0 10px 20px rgba(0,210,255,0.3);
        transform: translateY(-2px);
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .info-box {
        background-color: #eff6ff;
        border-left: 4px solid var(--primary-blue);
        padding: 15px;
        border-radius: 0 12px 12px 0;
    }
</style>

<div class="animate__animated animate__fadeIn max-w-3xl">
    <div class="content-card">
        
        <div class="mb-8">
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight flex items-center gap-3">
                <i class="bi bi-plus-circle-fill text-blue-600"></i> Tambah Layanan
            </h2>
            <p class="text-slate-400 text-sm font-medium mt-1">
                Silakan isi spesifikasi layanan publik baru untuk ditampilkan pada portal utama.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 animate__animated animate__shakeX">
                <div class="flex items-center gap-2 mb-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span class="font-bold text-sm">Terjadi Kesalahan:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.layanan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="info-box mb-4">
                <p class="text-xs text-blue-700 font-semibold mb-0">
                    <i class="bi bi-lightbulb-fill me-1"></i> Tip: Gunakan nama layanan yang singkat dan deskripsi yang mudah dipahami oleh masyarakat umum.
                </p>
            </div>

            <div>
                <label class="form-label-custom">Nama Layanan</label>
                <input 
                    type="text" 
                    name="nama_layanan" 
                    value="{{ old('nama_layanan') }}" 
                    required 
                    class="custom-input" 
                    placeholder="Misal: Pembuatan Kartu AK-1 (Kartu Kuning)"
                >
            </div>

            <div>
                <label class="form-label-custom">Deskripsi Lengkap</label>
                <textarea 
                    name="deskripsi" 
                    rows="5" 
                    class="custom-input" 
                    placeholder="Jelaskan secara singkat prosedur, syarat, atau kegunaan layanan ini..."
                >{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="btn-save shadow-sm flex items-center gap-2">
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <span>Simpan Layanan</span>
                </button>

                <a href="{{ route('admin.layanan.index') }}" class="btn-cancel flex items-center gap-2">
                    <i class="bi bi-x-lg"></i>
                    <span>Batalkan</span>
                </a>
            </div>
        </form>

    </div>
</div>

@endsection