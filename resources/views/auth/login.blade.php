@extends('layouts.guest')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary-blue: #0056b3;
        --accent-color: #00d2ff;
        --bg-light: #f8fbff;
    }

    /* MENGHILANGKAN GAP ATAS & SAMPING */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
    }

    /* SEMBUNYIKAN HEADER BAWAAN */
    nav, header, [class*="bg-blue"], .navbar-dark { 
        display: none !important; 
    }

    body { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        background-color: var(--bg-light); 
    }

    /* HEADER FULL WIDTH (PERSIS BERANDA/BUKU TAMU) */
    .header-full {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e5e7eb;
        width: 100%;
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 99999;
        display: block !important;
    }

    .header-container {
        max-width: 100%;
        padding: 12px 40px;
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

    .brand-logo-custom { height: 45px; width: auto; }

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
    }

    .nav-link-custom:hover, .nav-link-custom.active {
        color: var(--primary-blue) !important;
    }

    /* LOGIN CARD STYLING */
    .main-login-wrapper {
        padding-top: 120px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-bottom: 50px;
    }

    .login-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        overflow: hidden;
        width: 100%;
        max-width: 900px;
        display: flex;
        border: 1px solid rgba(0,0,0,0.02);
    }

    .login-info-side {
        background: linear-gradient(135deg, var(--primary-blue), #003a7a);
        padding: 45px;
        color: white;
        width: 45%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .login-form-side {
        padding: 45px;
        width: 55%;
        background: white;
    }

    .custom-input {
        width: 100%;
        padding: 14px 18px;
        background: #f1f4f9;
        border: 2px solid transparent;
        border-radius: 12px;
        font-weight: 500;
        transition: 0.3s;
    }

    .custom-input:focus {
        background: #fff;
        border-color: var(--primary-blue);
        outline: none;
        box-shadow: 0 10px 20px rgba(0,86,179,0.05);
    }

    .btn-login-gradient {
        background: linear-gradient(90deg, var(--primary-blue), var(--accent-color));
        color: white;
        border: none;
        width: 100%;
        padding: 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.4s;
    }

    .btn-login-gradient:hover {
        box-shadow: 0 12px 24px rgba(0,210,255,0.3);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .login-info-side { display: none; }
        .login-form-side { width: 100%; }
        .login-card { max-width: 450px; }
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
            <li><a href="/buku-tamu" class="nav-link-custom">Buku Tamu</a></li>
            <li><a href="/login" class="nav-link-custom active">Admin</a></li>
        </ul>
    </div>
</div>

<div class="main-login-wrapper animate__animated animate__fadeIn">
    <div class="login-card">
        
        <div class="login-info-side animate__animated animate__fadeInLeft">
            <div>
                <h2 class="fw-800 text-3xl mb-4" style="font-weight: 800; letter-spacing: -1px;">Admin Panel</h2>
                <p class="opacity-80 leading-relaxed">
                    Selamat datang di sistem manajemen Buku Tamu Digital Dinas Koperasi, Usaha Mikro, dan Ketenagakerjaan Kota Kediri.
                </p>
            </div>
            <div class="p-4 rounded-3" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                <p class="small mb-0 opacity-90 italic">"Kelola data layanan dan pantau kunjungan masyarakat dengan lebih efisien."</p>
            </div>
        </div>

        <div class="login-form-side">
            <div class="mb-5">
                <h3 class="fw-bold text-dark mb-2" style="font-weight: 700;">Login Admin</h3>
                <p class="text-muted small">Masukkan kredensial Anda untuk masuk.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4 p-3 small animate__animated animate__shakeX" style="background-color: #fee2e2; color: #b91c1c;">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> Email atau password salah.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="small fw-bold text-gray-700 mb-2 d-block">Email Address</label>
                    <input type="email" name="email" class="custom-input" placeholder="a@kedirikota.go.id" required autofocus>
                </div>

                <div class="mb-4">
                    <label class="small fw-bold text-gray-700 mb-2 d-block">Password</label>
                    <input type="password" name="password" class="custom-input" placeholder="••••••••" required>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small text-muted" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-login-gradient shadow">
                    Masuk Sekarang <i class="bi bi-box-arrow-in-right ms-2"></i>
                </button>

                <div class="text-center mt-5">
                    <a href="/" class="text-muted text-decoration-none small hover:text-primary transition">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection