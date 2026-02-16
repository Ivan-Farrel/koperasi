<?php

namespace App\Exports;

use App\Models\BukuTamu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuTamuExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return BukuTamu::with('layanan')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'Nama'       => $item->nama,
                    'Kecamatan'  => $item->kecamatan,
                    'Kelurahan'  => $item->kelurahan,
                    'Alamat'     => $item->alamat,
                    'No HP'      => $item->no_hp,
                    'Layanan'    => optional($item->layanan)->nama_layanan,
                    'Keterangan' => $item->keterangan,
                    'Tanggal'    => $item->created_at->format('d-m-Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kecamatan',
            'Kelurahan',
            'Alamat',
            'No HP',
            'Layanan',
            'Keterangan',
            'Tanggal',
        ];
    }
}
