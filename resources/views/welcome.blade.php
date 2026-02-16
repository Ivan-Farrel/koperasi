@extends('layouts.guest')

@section('content')

{{-- CAROUSEL / BANNER --}}
<div class="relative overflow-hidden rounded-2xl shadow mb-10" id="carousel">
    <div class="relative h-64 md:h-80 bg-gray-200">
        <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-100">
            <img src="{{ asset('images/banner1.jpg') }}" class="w-full h-full object-cover" alt="Banner 1">
        </div>
        <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-0">
            <img src="{{ asset('images/banner2.jpg') }}" class="w-full h-full object-cover" alt="Banner 2">
        </div>
        <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-0">
            <img src="{{ asset('images/banner3.jpg') }}" class="w-full h-full object-cover" alt="Banner 3">
        </div>
    </div>
</div>

{{-- HERO CARD: STATUS + INFO --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

    {{-- CARD BESAR: STATUS SISTEM --}}
    <div class="lg:col-span-2 relative overflow-hidden rounded-2xl shadow min-h-[220px]">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-800 to-blue-500"></div>

        <!-- Content -->
        <div class="relative p-8 text-white flex flex-col justify-between h-full">
            <div>
                <h2 class="text-3xl font-bold mb-2">Status Pelayanan</h2>

                @if($statusSistem === 'aktif')
                    <p class="text-4xl font-bold text-green-300">Aktif</p>
                    <p class="text-blue-100 mt-2">
                        Pelayanan sedang dibuka dan siap melayani masyarakat.
                    </p>
                @else
                    <p class="text-4xl font-bold text-yellow-300">Sedang Istirahat</p>
                    <p class="text-blue-100 mt-2">
                        Pelayanan sedang ditutup sementara. Silakan datang kembali nanti.
                    </p>
                @endif
            </div>

            <div class="mt-6 flex gap-4">
                <a href="/buku-tamu"
                   class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                    Isi Buku Tamu
                </a>
                <a href="{{ route('login') }}"
                   class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-700 transition">
                    Login Admin
                </a>
            </div>
        </div>
    </div>

    {{-- CARD KECIL: PELAYANAN TERPADU --}}
    <div class="bg-white rounded-2xl p-6 shadow flex flex-col justify-center items-center text-center">
        <h3 class="text-xl font-bold mb-2">Pelayanan Terpadu</h3>
        <p class="text-gray-600 text-sm">
            Melayani masyarakat Kota Kediri dengan cepat, transparan, dan profesional.
        </p>
    </div>

</div>

{{-- STATS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500 text-sm">Total Layanan</p>
        <p class="text-3xl font-bold mt-2">{{ $layanans->count() }}</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500 text-sm">Melayani Masyarakat</p>
        <p class="text-3xl font-bold mt-2">Kota Kediri</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500 text-sm mb-2">Jam Operasional</p>

        <p class="text-lg font-semibold text-gray-800">Senin – Jumat</p>
        <p class="text-2xl font-bold text-blue-600 mt-1">08.00 – 15.00 WIB</p>

        <p class="text-sm text-gray-500 mt-2">
            Sabtu, Minggu & Libur Nasional: Tutup
        </p>
    </div>

</div>

{{-- SECTION LAYANAN --}}
<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold">Layanan Kami</h3>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($layanans as $layanan)
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="mb-3">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg font-bold">
                    {{ strtoupper(substr($layanan->nama_layanan, 0, 1)) }}
                </div>
            </div>
            <h4 class="font-bold text-lg mb-2">{{ $layanan->nama_layanan }}</h4>
            <p class="text-gray-600 text-sm">{{ $layanan->deskripsi }}</p>
        </div>
    @endforeach
</div>

<script>
    const items = document.querySelectorAll('#carousel .carousel-item');
    let current = 0;

    if (items.length > 0) {
        setInterval(() => {
            items[current].classList.remove('opacity-100');
            items[current].classList.add('opacity-0');

            current = (current + 1) % items.length;

            items[current].classList.remove('opacity-0');
            items[current].classList.add('opacity-100');
        }, 4000);
    }
</script>

@endsection
