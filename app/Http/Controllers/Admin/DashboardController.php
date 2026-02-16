<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pengunjung = BukuTamu::latest()->take(10)->get();
        $totalPengunjung = BukuTamu::count();
        $totalLayanan = Layanan::count();

        $status = DB::table('settings')->where('key', 'system_status')->value('value');

        return view('admin.dashboard', compact(
            'pengunjung',
            'totalPengunjung',
            'totalLayanan',
            'status'
        ));
    }

    public function toggleStatus()
    {
        $current = DB::table('settings')->where('key', 'system_status')->value('value');

        $newStatus = $current === 'aktif' ? 'istirahat' : 'aktif';

        DB::table('settings')->where('key', 'system_status')->update([
            'value' => $newStatus
        ]);

        return redirect()->back()->with('success', 'Status sistem berhasil diubah.');
    }
}
