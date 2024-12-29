<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KegiatanExport implements FromCollection, WithHeadings, WithMapping
{
    // Mengambil semua data kegiatan
    public function collection()
    {
        return Kegiatan::all();
    }

    // Menambahkan header kolom
    public function headings(): array
    {
        return ['No', 'Nama Kegiatan', 'Tim Kerja', 'Mulai', 'Berakhir', 'Target', 'Realisasi', 'Satuan'];
    }

    // Mapping data untuk setiap baris
    public function map($kegiatan): array
    {
        static $no = 1;
        return [
            $no++, // Nomor urut
            $kegiatan->nama_kegiatan,
            $kegiatan->tim_kerja,
            $kegiatan->mulai,
            $kegiatan->berakhir,
            $kegiatan->target,
            $kegiatan->realisasi,
            $kegiatan->satuan,
        ];
    }
}
