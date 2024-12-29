<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Exports\KegiatanExport;
use Maatwebsite\Excel\Facades\Excel;

class PJController extends Controller
{
    // Menampilkan Daftar Kegiatan dengan Pagination
    public function index(Request $request)
    {
        // Ambil data filter dari query string
        $teamName = $request->get('team');
        $month = $request->get('month');
        $year = $request->get('year');

        $query = Kegiatan::query();

        // Menambahkan kondisi filter jika ada
        if ($teamName) {
            $query->where('tim_kerja', 'LIKE', "%{$teamName}%");
        }

        if ($month) {
            $query->whereMonth('mulai', $month);
        }

        if ($year) {
            $query->whereYear('mulai', $year);
        }

        // Mengambil data dengan pagination
        $kegiatan = $query->paginate(30);

        // Mengambil daftar tim kerja yang unik untuk dropdown filter
        $teams = Kegiatan::select('tim_kerja')->distinct()->pluck('tim_kerja');

        // Menghitung progres target/realisasi dan durasi untuk setiap kegiatan
        foreach ($kegiatan as $index => $item) {
            // Hitung progres target/realisasi
            $targetProgress = ($item->realisasi / $item->target) * 100;

            // Hitung durasi progres
            $mulai = \Carbon\Carbon::parse($item->mulai);
            $berakhir = \Carbon\Carbon::parse($item->berakhir);
            $hariIni = \Carbon\Carbon::now();

            $durasiTotal = $mulai->diffInDays($berakhir) ?: 1;
            $durasiTerpakai = $mulai->diffInDays(min($hariIni, $berakhir));

            $durationProgress = $hariIni >= $berakhir ? 100 : ($durasiTerpakai / $durasiTotal) * 100;

            // Menyimpan data dalam objek untuk dikirim ke view
            $item->no = $index + 1;
            $item->target_progress = round($targetProgress, 2);
            $item->duration_progress = round($durationProgress, 2);
        }

        // Tampilkan ke view 'daftarkegiatan' dengan mengirimkan variabel $kegiatan dan $teams
        return view('daftarkegiatan', ['kegiatan' => $kegiatan, 'teams' => $teams]);
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

    // Menampilkan Halaman Edit Kegiatan
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('editkegiatan', compact('kegiatan'));
    }

    // Mengupdate Kegiatan di Database
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

    // Menghapus Kegiatan dari Database
    public function destroy($id)
    {
        // Cari kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Hapus data
        $kegiatan->delete();

        // Redirect ke halaman daftar kegiatan dengan pesan sukses
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function download($format)
    {
        // Cek apakah format adalah 'excel' atau 'csv'
        if ($format == 'excel') {
            // Jika format Excel
            return Excel::download(new KegiatanExport, 'kegiatan.xlsx');
        } elseif ($format == 'csv') {
            // Jika format CSV
            return Excel::download(new KegiatanExport, 'kegiatan.csv', \Maatwebsite\Excel\Excel::CSV);
        }

        // Jika format tidak valid
        return response()->json(['error' => 'Format tidak valid'], 400);
    }

    public function printPage()
    {
        $kegiatan = Kegiatan::all();
        return view('printkegiatan', compact('kegiatan'));
    }
}
