<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Dinas UMKM Kediri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white flex flex-col">
        <div class="p-6 text-xl font-bold border-b border-blue-600">
            Admin Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                📊 <span>Dashboard</span>
            </a>
            <a href="/admin/layanan" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                🗂️ <span>Layanan</span>
            </a>
            <a href="/admin/buku-tamu" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                📝 <span>Buku Tamu</span>
            </a>
        </nav>

        <div class="p-4 border-t border-blue-600">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-700">@yield('title', 'Dashboard')</h1>
            <div class="text-sm text-gray-600">
                👤 {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
