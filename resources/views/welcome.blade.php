<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinkop UMTK Kota Kediri - Pelayanan Modern</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo-kediri.svg') }}">

    <style>
        :root {
            --primary-color: #0056b3;
            --accent-color: #00d2ff;
            --bg-light: #f8fbff;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-light); 
            color: #2d3436;
        }

        /* Navbar Menu Kanan */
        .navbar-custom { 
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 12px 0;
        }
        .brand-text { color: var(--primary-color); font-weight: 800; line-height: 1.1; letter-spacing: -0.5px; }
        .nav-link { font-weight: 600; color: #4b5563 !important; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color) !important; }

        /* Carousel Banner Tengah */
        .carousel-container {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            height: 350px;
            margin-bottom: 2.5rem;
        }
        .carousel-item-img {
            width: 100%; height: 100%; object-fit: cover;
            transition: opacity 0.7s ease-in-out;
            position: absolute; top: 0; left: 0;
        }
        .carousel-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.4), transparent);
            z-index: 1;
        }

        /* Card Status & Info (Logika Kodingan 2) */
        .status-card {
            background: linear-gradient(135deg, #003060, #0056b3);
            border-radius: 24px; color: white; padding: 40px; height: 100%;
            position: relative;
        }
        .info-card {
            background: white; border-radius: 24px; padding: 25px;
            border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }

        /* Grid Layanan (Logika Kodingan 2) */
        .layanan-card {
            background: white; padding: 30px; border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; height: 100%;
        }
        .layanan-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,86,179,0.1); }
        .icon-box {
            width: 45px; height: 45px; background: #e7f1ff; color: var(--primary-color);
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px; font-weight: 800; margin-bottom: 15px;
        }

        footer { background: #0f172a; color: rgba(255,255,255,0.7); padding: 50px 0 30px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg/1280px-Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg.png" alt="Logo" height="45" class="me-3">
            <div class="brand-text">DINKOP UMTK<br><span class="text-muted fw-normal small">KOTA KEDIRI</span></div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/buku-tamu">Buku Tamu</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="carousel-container animate__animated animate__fadeIn">
        <div class="carousel-overlay"></div>
        <img src="{{ asset('image/banner1.png') }}" class="carousel-item-img" style="opacity:1">
        <img src="{{ asset('image/banner2.png') }}" class="carousel-item-img" style="opacity:0">
        <img src="{{ asset('image/banner3.png') }}" class="carousel-item-img" style="opacity:0">
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
            <div class="status-card shadow-lg">
                <h2 class="fw-800 mb-3">Status Pelayanan</h2>
                
                @if($statusSistem === 'aktif')
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i> Aktif
                        </span>
                    </div>
                    <p class="opacity-90">Pelayanan sedang dibuka dan siap melayani masyarakat Kota Kediri.</p>
                @else
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                            <i class="bi bi-clock-fill me-1"></i> Sedang Istirahat
                        </span>
                    </div>
                    <p class="opacity-90">Pelayanan sedang ditutup sementara. Silakan kembali pada jam operasional.</p>
                @endif

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="/buku-tamu" class="btn btn-light fw-bold rounded-3 px-4 py-2">Isi Buku Tamu</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light fw-bold rounded-3 px-4 py-2">Login Admin</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <div class="info-card h-100 d-flex flex-column justify-content-center text-center">
                <div class="icon-box mx-auto shadow-sm">
                    <i class="bi bi-building-fill-check fs-4"></i>
                </div>
                <h4 class="fw-bold">Pelayanan Terpadu</h4>
                <p class="text-muted small mb-0">Melayani masyarakat Kota Kediri dengan transparan dan profesional.</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5 text-center">
        <div class="col-md-4">
            <div class="info-card">
                <p class="text-muted small mb-1">Total Layanan</p>
                <h3 class="fw-800 mb-0">{{ $layanans->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <p class="text-muted small mb-1">Wilayah Layanan</p>
                <h3 class="fw-800 mb-0">Kota Kediri</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card" style="border-top: 4px solid var(--primary-color);">
                <p class="text-muted small mb-1">Jam Operasional</p>
                <h5 class="fw-bold text-primary mb-0">08.00 – 15.00 WIB</h5>
                <p class="extra-small text-muted mb-0" style="font-size: 0.7rem;">Senin - Jumat</p>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h3 class="fw-800 mb-1">Layanan Kami</h3>
    </div>

    <div class="row g-4 mb-5">
        @foreach($layanans as $layanan)
            <div class="col-md-4">
                <div class="layanan-card shadow-sm">
                    <div class="icon-box shadow-sm">
                        {{ strtoupper(substr($layanan->nama_layanan, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold text-dark">{{ $layanan->nama_layanan }}</h5>
                    <p class="text-muted small mb-0">{{ $layanan->deskripsi }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<footer>
    <div class="container text-center">
        <h5 class="fw-bold text-white mb-4">Dinas Koperasi & UMTK Kota Kediri</h5>
        <div class="d-flex justify-content-center gap-3 mb-4">
            <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
        </div>
        <p class="small mb-0 opacity-50">&copy; 2026 Pemerintah Kota Kediri. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const items = document.querySelectorAll('.carousel-item-img');
    let current = 0;
    if (items.length > 0) {
        setInterval(() => {
            items[current].style.opacity = 0;
            current = (current + 1) % items.length;
            items[current].style.opacity = 1;
        }, 4000);
    }
</script>
</body>
</html>