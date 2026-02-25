<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Buku Tamu')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

     <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg/1280px-Logo_Kota_Kediri_-_Seal_of_Kediri_City.svg.png">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- TOP BAR --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                    
                </div>
                <div>
                    <p class="font-bold">Dinas Koperasi UMKM Mikro Dan Ketenegakerjaan Kota Kediri</p>
                    <p class="text-sm text-gray-500">Rekap Data Buku Tamu</p>
                </div>
            </div>

            <!-- <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                ⬅ Kembali ke Dashboard
            </a> -->
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-6">
        @yield('content')
    </main>

</body>
</html>
