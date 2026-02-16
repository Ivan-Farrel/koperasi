<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Dinas UMKM Kediri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white p-5">
            <h1 class="text-xl font-bold mb-6">Admin Panel</h1>
            <nav class="space-y-2">
                <a href="{{ route('admin.layanan.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">Layanan</a>
                <a href="/dashboard" class="block px-3 py-2 rounded hover:bg-slate-700">Dashboard</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
