@extends('admin.layout')

@section('content')
<div class="p-8 animate__animated animate__fadeIn space-y-8">
    
    {{-- Header Page --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.layanan.index') }}" 
           class="w-12 h-12 bg-white border border-slate-100 rounded-2xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:shadow-lg transition-all">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Layanan</h2>
            <p class="text-sm font-bold text-slate-400 mt-1 uppercase tracking-widest">Perbarui informasi layanan publik Dinkop UMTK</p>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" class="p-8 md:p-12">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Form Sisi Kiri --}}
                <div class="lg:col-span-8 space-y-8">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 block px-1">Judul Layanan</label>
                        <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" 
                               class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all shadow-sm" 
                               placeholder="Masukkan judul layanan..." required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 block px-1">Deskripsi Detail</label>
                        <textarea name="deskripsi" rows="8" 
                                  class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all shadow-sm" 
                                  placeholder="Jelaskan detail layanan..." required>{{ $layanan->deskripsi }}</textarea>
                    </div>
                </div>

                {{-- Sisi Kanan: Panel Info --}}
                <div class="lg:col-span-4">
                    <div class="h-full bg-gradient-to-br from-slate-800 to-slate-900 rounded-[32px] p-8 text-white relative overflow-hidden flex flex-col justify-center">
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6">
                                <i class="bi bi-info-circle-fill text-3xl text-blue-400"></i>
                            </div>
                            <h5 class="text-xl font-black mb-4 tracking-tight">Panduan Update</h5>
                            <div class="space-y-4 opacity-80 text-sm font-medium leading-relaxed">
                                <p>● Gunakan bahasa yang mudah dipahami warga Kota Kediri.</p>
                                <p>● Periksa kembali deskripsi agar informasi yang disampaikan akurat.</p>
                                <p>● Judul singkat lebih efektif untuk tampilan di mobile/HP.</p>
                            </div>
                            <div class="mt-10 pt-6 border-t border-white/10 flex items-center gap-3">
                                <i class="bi bi-shield-check text-blue-400 text-xl"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest text-blue-400">Sistem Terintegrasi</span>
                            </div>
                        </div>
                        {{-- Ornamen --}}
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-12 pt-8 border-t border-slate-50 flex justify-end gap-4">
                <a href="{{ route('admin.layanan.index') }}" 
                   class="px-8 py-4 rounded-2xl text-sm font-black text-slate-400 hover:bg-slate-50 transition-all uppercase tracking-widest">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black text-sm shadow-xl shadow-blue-100 transition-all flex items-center gap-3 uppercase tracking-widest">
                    Simpan Perubahan <i class="bi bi-check-lg"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection