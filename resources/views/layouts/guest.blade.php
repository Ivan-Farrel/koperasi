<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dinas Koperasi UMKM Kota Kediri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- HEADER / NAVBAR -->
    <header class="bg-blue-700 text-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="font-bold text-lg">
                Dinas Koperasi UMKM Kota Kediri
            </h1>
            <nav class="space-x-6">
                <a href="/" class="hover:underline">Beranda</a>
                <a href="/buku-tamu" class="hover:underline">Buku Tamu</a>
                <a href="{{ route('login') }}" class="hover:underline">Admin</a>
            </nav>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 w-full">
        <div class="max-w-6xl mx-auto px-6 py-8">
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white text-center py-4">
        © {{ date('Y') }} Dinas Koperasi UMKM Kota Kediri
    </footer>

</body>
</html>
