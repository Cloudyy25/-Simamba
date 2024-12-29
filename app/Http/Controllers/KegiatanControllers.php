<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KegiatanController extends Controller
{
    // Menampilkan Daftar Kegiatan
    public function index()
    {
        // Mengambil data dengan pagination, maksimal 30 per halaman
        $kegiatan = Kegiatan::paginate(30);

        // Mengubah data kegiatan dengan map()
        $kegiatan->getCollection()->transform(function ($item, $index) {
            // Hitung progres target/realisasi
            $targetProgress = ($item->realisasi / $item->target) * 100;

            // Hitung durasi progres
            $mulai = Carbon::parse($item->mulai);
            $berakhir = Carbon::parse($item->berakhir);
            $hariIni = Carbon::now();

            $durasiTotal = $mulai->diffInDays($berakhir) ?: 1; // Total durasi (minimal 1 hari)
            $durasiTerpakai = $mulai->diffInDays(min($hariIni, $berakhir)); // Hari berlalu sampai sekarang
            $durationProgress = ($durasiTerpakai / $durasiTotal) * 100;

            return [
                'no' => $index + 1,
                'id' => $item->id, // Tambahkan ID untuk identifikasi data
                'nama_kegiatan' => $item->nama_kegiatan,
                'tim_kerja' => $item->tim_kerja,
                'mulai' => $item->mulai,
                'berakhir' => $item->berakhir,
                'target' => $item->target,
                'realisasi' => $item->realisasi,
                'satuan' => $item->satuan,
                'spj' => $item->spj,
                'target_progress' => round($targetProgress, 2),
                'duration_progress' => round($durationProgress, 2),
            ];
        });

        // Tampilkan ke view 'daftarkegiatan'
        return view('daftarkegiatan', ['kegiatan' => $kegiatan]);
    }

    // Menampilkan Halaman Tambah Kegiatan
    public function create()
    {
        // Tampilkan halaman tambah kegiatan
        return view('tambahkegiatan');
    }

    // Menyimpan Kegiatan Baru ke Database
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tim_kerja' => 'required|string|max:255',
            'mulai' => 'required|date',
            'berakhir' => 'required|date',
            'target' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'satuan' => 'required|string|max:255',
        ]);

        // Simpan data kegiatan ke dalam database
        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tim_kerja' => $request->tim_kerja,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir,
            'target' => $request->target,
            'realisasi' => $request->realisasi,
            'satuan' => $request->satuan,
        ]);
        // Kembali ke halaman daftar kegiatan dengan pesan sukses
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('editkegiatan', compact('kegiatan'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tim_kerja' => 'required|string|max:255',
            'target' => 'required|numeric|min:1',
            'realisasi' => 'required|numeric|min:0',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($validatedData);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Hapus data
        $kegiatan->delete();

        // Redirect ke halaman daftar kegiatan dengan pesan sukses
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }



}
