<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dinkop UMTK Kediri</title>
    
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg/1280px-Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        .sidebar-link.active {
            background-color: #f1f5f9;
            color: #2563eb;
        }
        .sidebar-link.active i {
            color: #2563eb;
        }
    </style>
</head>
<body class="antialiased">

<div class="flex min-h-screen">
    <aside class="w-72 bg-white border-r border-gray-100 fixed h-full flex flex-col z-50">
        
        <div class="p-8 flex items-center gap-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg/1200px-Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg.png" 
                class="w-12 h-12 object-contain" 
                alt="Logo Kediri">
            
            <div class="flex flex-col">
                <h1 class="text-sm font-black text-slate-800 tracking-tighter leading-none uppercase">
                    Dinkop UMTK
                </h1>
                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-[0.15em] leading-none">
                    Kota Kediri
                </p>
            </div>
        </div>

        <nav class="flex-1 px-6 space-y-1.5 mt-2">
            <p class="px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4">Main Workspace</p>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-slate-500 hover:bg-slate-50' }}">
                <i class="bi bi-grid-1x2-fill text-lg"></i>
                <span class="text-sm font-bold">Dashboard</span>
            </a>

            <a href="{{ route('admin.layanan.index') }}" 
               class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.layanan.*') ? 'active' : 'text-slate-500 hover:bg-slate-50' }}">
                <i class="bi bi-layers-fill text-lg"></i>
                <span class="text-sm font-bold">Kelola Layanan</span>
            </a>

            <a href="{{ route('admin.carousel.index') }}" 
               class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.carousel.*') ? 'active' : 'text-slate-500 hover:bg-slate-50' }}">
                <i class="bi bi-images text-lg"></i>
                <span class="text-sm font-bold">Manajemen Banner</span>
            </a>

            <a href="{{ route('admin.buku_tamu.index') }}" 
               class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.buku_tamu.*') ? 'active' : 'text-slate-500 hover:bg-slate-50' }}">
                <i class="bi bi-journal-text text-lg"></i>
                <span class="text-sm font-bold">Buku Tamu</span>
            </a>

            <div class="pt-8">
                <p class="px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4">Account</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-red-50 hover:text-red-500 transition-all duration-300">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                        <span class="text-sm font-bold">Sign Out</span>
                    </button>
                </form>
            </div>
        </nav>

        <div class="mt-auto p-6 border-t border-slate-50">
            <div class="flex items-center gap-3 bg-slate-50/50 p-3 rounded-2xl border border-slate-100/50 shadow-sm">
                <div class="w-10 h-10 bg-gradient-to-tr from-sky-400 to-blue-600 rounded-xl flex items-center justify-center text-white font-black shadow-sm">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <h4 class="text-[11px] font-black text-slate-800 truncate">{{ auth()->user()->name ?? 'Admin Dinas' }}</h4>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Executive Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-72 min-h-screen">
        <div class="animate__animated animate__fadeIn">
            @yield('content')
        </div>
    </main>
</div>

</body>
</html>