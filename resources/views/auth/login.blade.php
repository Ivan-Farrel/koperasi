@extends('layouts.guest')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">

        {{-- LEFT: INFO / BRAND --}}
        <div class="hidden md:flex bg-gradient-to-br from-blue-600 to-blue-500 text-white rounded-2xl p-8 shadow flex-col justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-3">Admin Panel</h2>
                <p class="text-blue-100">
                    Sistem Buku Tamu Digital  
                    Dinas Koperasi, Usaha Mikro, dan Ketenagakerjaan Kota Kediri
                </p>
            </div>

            <div>
                <p class="text-sm text-blue-100">
                    Silakan login untuk mengelola data layanan dan buku tamu pengunjung.
                </p>
            </div>
        </div>

        {{-- RIGHT: LOGIN FORM --}}
        <div class="bg-white rounded-2xl p-8 shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    Email atau password salah.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" required
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" required
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Login
                </button>

                <div class="text-center mt-4">
                    <a href="/" class="text-blue-600 hover:underline text-sm">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
