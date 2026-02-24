@extends('admin.layout')

@section('content')
{{-- Konten Utama: Full Tailwind Executive Style --}}
<div class="p-8 animate__animated animate__fadeIn space-y-8">
    
    {{-- Header Page --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Manajemen Banner Carousel</h2>
            <p class="text-sm font-bold text-slate-400 mt-1 uppercase tracking-widest">Kelola gambar promosi untuk halaman utama</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
            <i class="bi bi-plus-lg text-lg"></i>
            Tambah Banner Baru
        </button>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-100 p-4 rounded-2xl flex items-center gap-3 animate__animated animate__lightSpeedInLeft">
        <i class="bi bi-check-circle-fill text-green-500"></i>
        <span class="text-sm font-bold text-green-700">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Grid Daftar Banner --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($carousels as $c)
        <div class="group bg-white rounded-[32px] overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
            {{-- Image Preview --}}
            <div class="relative h-52 overflow-hidden">
                <img src="{{ asset('storage/' . $c->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <p class="text-white text-xs font-bold uppercase tracking-widest">{{ $c->title ?? 'Tanpa Judul' }}</p>
                </div>
            </div>
            
            {{-- Action Bottom --}}
            <div class="p-6 flex justify-between items-center bg-white">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-blue-50 text-blue-600 uppercase tracking-wider">
                        Active Banner
                    </span>
                </div>
                <form action="{{ route('admin.carousel.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm shadow-red-100">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        {{-- Empty State Executive --}}
        <div class="col-span-full py-20 bg-white rounded-[40px] border border-dashed border-slate-200 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mb-4">
                <i class="bi bi-images text-4xl text-slate-300"></i>
            </div>
            <h4 class="text-lg font-black text-slate-800">Belum Ada Banner</h4>
            <p class="text-sm font-bold text-slate-400 mt-1 max-w-xs uppercase tracking-tighter">Silakan unggah gambar promosi pertama Anda untuk menghidupkan beranda.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- MODAL TAMBAH (TAILWIND STYLE) --}}
<div id="modalTambah" class="hidden fixed inset-0 z-[100] overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4 bg-slate-900/60 backdrop-blur-sm animate__animated animate__fadeIn">
        <div class="bg-white w-full max-w-md rounded-[32px] shadow-2xl overflow-hidden animate__animated animate__zoomIn">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h5 class="text-xl font-black text-slate-800 tracking-tight">Upload Banner</h5>
                <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-slate-400 hover:text-slate-800 transition-colors">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 block px-1">Judul Banner (Opsional)</label>
                    <input type="text" name="title" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Masukkan judul promo...">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 block px-1">Pilih File Gambar</label>
                    <div class="relative group">
                        <input type="file" name="image" required class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center text-sm font-bold text-slate-500 cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition-all">
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none group-hover:text-blue-500">
                             <i class="bi bi-cloud-arrow-up text-3xl mb-1"></i>
                             <span class="text-[10px] font-black uppercase tracking-widest">Click to Upload</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-2xl font-black text-sm shadow-xl shadow-blue-100 transition-all flex items-center justify-center gap-3">
                    SIMPAN BANNER <i class="bi bi-send-fill text-xs"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection