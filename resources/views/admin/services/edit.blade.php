@extends('admin.layout')

@section('content')
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f0f4f8; }
    .main-card { border: none; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #ffffff; }
    .form-control-modern { border-radius: 12px; padding: 15px; border: none; background-color: #f8fafc; transition: 0.3s; }
    .form-control-modern:focus { background-color: #fff; box-shadow: 0 0 0 4px rgba(0, 86, 179, 0.1); }
    .btn-save { background: linear-gradient(135deg, #0056b3, #00b4db); border: none; border-radius: 50px; padding: 12px 35px; font-weight: 700; color: white; }
</style>

<div class="py-4 px-md-5">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-white bg-white shadow-sm rounded-circle me-3" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
            <i class="bi bi-arrow-left text-primary fs-5"></i>
        </a>
        <h3 class="fw-bold mb-0">Edit Layanan</h3>
    </div>

    <div class="card main-card p-4 p-md-5">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Form Sisi Kiri --}}
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small mb-2">JUDUL LAYANAN</label>
                        {{-- name="judul" tetap dipakai, nanti di Controller kita arahkan ke nama_layanan --}}
                        <input type="text" name="judul" value="{{ $layanan->nama_layanan }}" class="form-control-modern w-100 shadow-sm" placeholder="Masukkan judul layanan..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small mb-2">DESKRIPSI DETAIL</label>
                        <textarea name="deskripsi" rows="6" class="form-control-modern w-100 shadow-sm" placeholder="Jelaskan detail layanan..." required>{{ $layanan->deskripsi }}</textarea>
                    </div>
                </div>

                {{-- Sisi Kanan: Panel Info --}}
                <div class="col-md-4">
                    <div class="p-4 bg-primary text-white rounded-5 shadow-sm h-100 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Informasi</h5>
                        <p class="small opacity-75">Halaman ini sekarang hanya melayani pembaruan teks judul dan deskripsi saja untuk mempercepat proses update data.</p>
                        <hr class="opacity-25">
                        <p class="small mb-0"><i class="bi bi-shield-check me-2"></i>Data langsung tersimpan ke database MySQL.</p>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-end mt-5 pt-3 border-top">
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-light px-4 py-2 rounded-pill fw-bold text-muted text-decoration-none small">BATAL</a>
                <button type="submit" class="btn btn-save shadow-sm">
                    SIMPAN PERUBAHAN <i class="bi bi-check-lg ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection