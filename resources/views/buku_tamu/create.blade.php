@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-start justify-center py-10 bg-gray-100">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg p-8">

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">📘 Buku Tamu Pengunjung</h1>
            <p class="text-gray-500 mt-2">
                Silakan isi data diri Anda sebelum mendapatkan layanan di Dinas Koperasi UMKM Kota Kediri
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('buku_tamu.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Nama --}}
            <div class="md:col-span-2">
                <label class="block mb-1 font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan nama lengkap" required>
            </div>

            {{-- Kecamatan --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Kecamatan</label>
                <select name="kecamatan" id="kecamatan"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    <option value="Mojoroto">Mojoroto</option>
                    <option value="Kota">Kota</option>
                    <option value="Pesantren">Pesantren</option>
                </select>
            </div>

            {{-- Kelurahan --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Kelurahan</label>
                <select name="kelurahan" id="kelurahan"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label class="block mb-1 font-semibold text-gray-700">Alamat</label>
                <textarea name="alamat" rows="3"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            {{-- No HP --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">No. HP</label>
                <input type="text" name="no_hp"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="08xxxxxxxxxx" required>
            </div>

            {{-- Layanan --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Pilih Layanan</label>
                <select name="layanan_id"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($layanans as $layanan)
                        <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Keterangan --}}
            <div class="md:col-span-2">
                <label class="block mb-1 font-semibold text-gray-700">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" rows="3"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Tambahkan keterangan jika perlu"></textarea>
            </div>

            {{-- Tombol --}}
            <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                <button type="reset"
                    class="px-6 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                    Reset
                </button>
                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow">
                    Kirim Data
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script Kecamatan -> Kelurahan (punya kamu tetap bisa dipakai) --}}
<script>
const dataWilayah = {
    "Mojoroto": ["Campurejo", "Bandar Kidul", "Lirboyo", "Mrican", "Ngampel", "Mojoroto"],
    "Kota": ["Balowerti", "Banjaran", "Dandangan", "Kaliombo", "Kampung Dalem", "Setonopande", "Setonogedong"],
    "Pesantren": ["Tempurejo", "Tinalan", "Burengan", "Bawang", "Betet", "Blabak"]
};

const kecamatanSelect = document.getElementById('kecamatan');
const kelurahanSelect = document.getElementById('kelurahan');

kecamatanSelect.addEventListener('change', function () {
    const kec = this.value;
    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

    if (dataWilayah[kec]) {
        dataWilayah[kec].forEach(function (kel) {
            const opt = document.createElement('option');
            opt.value = kel;
            opt.textContent = kel;
            kelurahanSelect.appendChild(opt);
        });
    }
});
</script>
@endsection
