<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin DINKOP UMTK</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --sidebar-width: 280px;
            --primary-blue: #0056b3;
            --sidebar-bg: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- SIDEBAR STARTUP STYLE --- */
        .sidebar-startup {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 1000;
        }

        .sidebar-brand { padding: 32px 24px; }
        .brand-wrapper { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo { height: 40px; width: auto; }
        .brand-name .main { display: block; font-weight: 800; font-size: 1.15rem; color: #1e293b; letter-spacing: -0.5px; }
        .brand-name .sub { font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }

        .nav-label { font-size: 0.65rem; font-weight: 800; text-transform: uppercase; color: #cbd5e1; padding: 0 28px; margin: 25px 0 12px; letter-spacing: 1.5px; }
        .nav-link-item {
            display: flex; align-items: center; gap: 12px; padding: 12px 24px; margin: 0 16px 4px;
            text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.95rem; border-radius: 12px; transition: 0.3s;
        }
        .nav-link-item i { font-size: 1.25rem; }
        .nav-link-item:hover { background: #f8fafc; color: #1e293b; }
        .nav-link-item.active { background: #eff6ff; color: var(--primary-blue); }
        .nav-link-item.logout-btn:hover { background: #fff1f2; color: #e11d48; }

        /* --- TOPBAR STYLE --- */
        .top-header {
            margin-left: var(--sidebar-width);
            height: 75px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px;
            position: sticky; top: 0; z-index: 900;
        }

        /* --- MAIN CONTENT --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 40px;
            min-height: calc(100vh - 75px);
        }

        .user-avatar-box {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, #00d2ff, var(--primary-blue));
            border-radius: 12px; color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <aside class="sidebar-startup">
        <div class="sidebar-brand">
            <div class="brand-wrapper">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg/1280px-Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg.png" alt="Logo" class="brand-logo">
                <div class="brand-name">
                    <span class="main">DINKOP UMTK</span>
                    <span class="sub">KOTA KEDIRI</span>
                </div>
            </div>
        </div>

        <p class="nav-label">Main Workspace</p>
        <a href="{{ route('admin.dashboard') }}" class="nav-link-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.layanan.index') }}" class="nav-link-item {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            <i class="bi bi-stack"></i> <span>Kelola Layanan</span>
        </a>
        <a href="{{ route('admin.buku_tamu.index') }}" class="nav-link-item {{ request()->routeIs('admin.buku_tamu.*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> <span>Buku Tamu</span>
        </a>

        <p class="nav-label">Account</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link-item logout-btn">
                <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span>
            </a>
        </form>

        <div class="mt-auto p-6 border-t border-slate-50 flex items-center gap-3">
            <div class="user-avatar-box">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800 m-0">{{ auth()->user()->name ?? 'Admin Dinas' }}</p>
                <p class="text-[10px] text-slate-400 font-bold uppercase m-0">Executive Admin</p>
            </div>
        </div>
    </aside>

    <header class="top-header">
        <div>
            <span class="text-slate-800 text-lg font-bold">@yield('title')</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden md:flex bg-slate-100 px-3 py-1.5 rounded-lg items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-bold text-slate-500 tracking-wider">LIVE SYSTEM</span>
            </div>
            <i class="bi bi-person-circle text-2xl text-slate-400"></i>
        </div>
    </header>

    <main class="main-wrapper">
        @yield('content')
    </main>

</body>
</html>