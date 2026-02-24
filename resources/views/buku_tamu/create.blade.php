@extends('admin.layout')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="icon" type="image/svg+xml" href="{{ asset('logo-kediri.svg') }}">

<style>
    :root {
        --primary-blue: #0056b3;
        --bg-light: #f8fbff;
    }

    /* 1. MENGHILANGKAN GAP ATAS & SAMPING PADA BODY */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
    }

    /* PAKSA HAPUS ELEMEN BAWAAN LAYOUT YANG MUNGKIN MENYEBABKAN GAP */
    nav, header, [class*="bg-blue"], .navbar-dark { 
        display: none !important; 
    }

    /* 2. HEADER FULL WIDTH (MENEMPEL KE ATAS & SAMPING) */
    .header-full {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e5e7eb;
        width: 100%;
        position: fixed; /* Menempel tetap di atas */
        top: 0;
        left: 0;
        right: 0;
        z-index: 99999;
        display: block !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .header-container {
        max-width: 100%; /* Membuat header mengikuti lebar layar */
        padding: 12px 40px; /* Padding samping agar logo tidak terlalu mepet tembok */
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .brand-area {
        display: flex;
        align-items: center;
        text-decoration: none;
        gap: 15px;
    }

    .brand-logo-custom {
        height: 45px;
        width: auto;
    }

    .brand-text-top {
        color: var(--primary-blue);
        font-weight: 800;
        font-size: 1.2rem;
        line-height: 1;
        display: block;
    }

    .brand-text-bottom {
        color: #6b7280;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* MENU KANAN */
    .nav-right-menu {
        display: flex !important;
        gap: 30px !important;
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .nav-link-custom {
        font-weight: 600;
        color: #4b5563 !important;
        font-size: 0.95rem;
        text-decoration: none !important;
        transition: 0.3s;
    }

    .nav-link-custom:hover, .nav-link-custom.active {
        color: var(--primary-blue) !important;
    }

    /* 3. KONTEN TENGAH (DIBERI JARAK ATAS KARENA HEADER FIXED) */
    .main-content-wrapper {
        padding-top: 100px; /* Memberi ruang agar konten tidak tertutup header fixed */
        padding-bottom: 50px;
        max-width: 900px;
        margin: 0 auto;
    }

    .form-box {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px;
        margin-top: 20px;
    }

    .custom-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #374151;
        margin-bottom: 8px;
        display: block;
    }

    .custom-input-field {
        width: 100%;
        padding: 12px 15px;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.95rem;
        box-sizing: border-box;
    }

    .custom-input-field:focus {
        outline: none;
        border-color: var(--primary-blue);
        background: #fff;
    }

    .btn-submit-guestbook {
        background: var(--primary-blue);
        color: #fff;
        border: none;
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 15px;
    }
</style>

<div class="header-full">
    <div class="header-container">
        <a href="/" class="brand-area">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg/1280px-Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg.png" alt="Logo" class="brand-logo-custom">
            <div>
                <span class="brand-text-top">DINKOP UMTK</span>
                <span class="brand-text-bottom">KOTA KEDIRI</span>
            </div>
        </a>

        <ul class="nav-right-menu">
            <li><a href="/" class="nav-link-custom">Beranda</a></li>
            <li><a href="/buku-tamu" class="nav-link-custom active">Buku Tamu</a></li>
            <li><a href="/login" class="nav-link-custom">Admin</a></li>
        </ul>
    </div>
</div>

<div class="main-content-wrapper animate__animated animate__fadeIn">
    
    <div class="text-center mb-4">
        <h1 style="font-weight: 800; color: #111827; font-size: 2.5rem; margin-bottom: 5px;">Welcome</h1>
        <p class="text-muted">Silakan isi buku tamu untuk mendata kunjungan Anda.</p>
    </div>

    <div class="form-box">
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 mb-4 p-3 shadow-sm small">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('buku_tamu.store') }}" method="POST">
            @csrf
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">
                <div style="flex: 1 1 100%;">
                    <label class="custom-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="custom-input-field" placeholder="Nama Lengkap Anda" required>
                </div>

                <div style="flex: 1 1 calc(50% - 10px);">
                    <label class="custom-label">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="custom-input-field" required>
                        <option value="">-- Pilih Kecamatan --</option>
                        <option value="Mojoroto">Mojoroto</option>
                        <option value="Kota">Kota</option>
                        <option value="Pesantren">Pesantren</option>
                    </select>
                </div>
                <div style="flex: 1 1 calc(50% - 10px);">
                    <label class="custom-label">Kelurahan</label>
                    <select name="kelurahan" id="kelurahan" class="custom-input-field" required>
                        <option value="">-- Pilih Kelurahan --</option>
                    </select>
                </div>

                <div style="flex: 1 1 calc(50% - 10px);">
                    <label class="custom-label">WhatsApp</label>
                    <input type="text" name="no_hp" class="custom-input-field" placeholder="08..." required>
                </div>
                <div style="flex: 1 1 calc(50% - 10px);">
                    <label class="custom-label">Layanan Tujuan</label>
                    <select name="layanan_id" class="custom-input-field" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="flex: 1 1 100%;">
                    <label class="custom-label">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2" class="custom-input-field" placeholder="Alamat domisili Anda"></textarea>
                </div>

                <div style="flex: 1 1 100%;">
                    <button type="submit" class="btn-submit-guestbook">Kirim Data Kunjungan</button>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center mt-5">
        <p class="small text-muted">&copy; 2026 Pemerintah Kota Kediri</p>
    </div>
</div>

<script>
    // Script Kelurahan tetap sama
    const dataWilayah = {
        "Mojoroto": ["Bandar Kidul", "Bandar Lor", "Banjarmelati", "Bujel", "Campurejo", "Dermo", "Gayam", "Lirboyo","Mojoroto", "Mrican", "Ngampel", "Pjok", "Sukorame", "Tamanan"],
        "Kota": ["Balowerti", "Banjaran", "Dandangan", "Jagalan", "Kaliombo", "Kampung Dalem", "Kemasan", "Manisrenggo", "Ngadirejo", "Ngronggo", "Pakelan", "Pocanan", "Rejomulyo","Ringinanom","Semampir","Setonogedong","Setonopande"],
        "Pesantren": ["Tempurejo", "Tinalan", "Burengan", "Bawang", "Betet", "Blabak", "Banaran", "Bangsal", "Jamsaren", "Ketami", "Pakunden", "Ngeleteh", "Pesantren", "Singonegharan", "Tosaren"]
    };

    const kecamatanSelect = document.getElementById('kecamatan');
    const kelurahanSelect = document.getElementById('kelurahan');

    kecamatanSelect.addEventListener('change', function () {
        const kec = this.value;
        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        if (dataWilayah[kec]) {
            dataWilayah[kec].forEach(kel => {
                const opt = document.createElement('option');
                opt.value = kel;
                opt.textContent = kel;
                kelurahanSelect.appendChild(opt);
            });
        }
    });
</script>
@endsection