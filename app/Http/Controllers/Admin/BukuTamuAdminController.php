<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Exports\BukuTamuExport;
use Maatwebsite\Excel\Facades\Excel;

class BukuTamuAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = BukuTamu::with('layanan')->latest();

        // 🔍 Search nama / layanan
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhereHas('layanan', function ($l) use ($q) {
                        $l->where('nama_layanan', 'like', "%{$q}%");
                    });
            });
        }

        // 📌 Filter layanan
        if ($request->filled('layanan')) {
            $query->where('layanan_id', $request->layanan);
        }

        // 📅 Filter tanggal dari
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // 📅 Filter tanggal sampai
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $pengunjung = $query->paginate(10)->withQueryString();

        // Untuk dropdown layanan di filter
        $layanans = Layanan::orderBy('nama_layanan')->get();

        return view('admin.buku_tamu.index', compact('pengunjung', 'layanans'));
    }

    public function export(Request $request)
    {
        return Excel::download(new BukuTamuExport($request), 'buku_tamu.xlsx');
    }
}
