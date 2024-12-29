<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan; // Model Kegiatan
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();

        // Validasi apakah user sudah login
        if (!$user) {
            return redirect('/login')->withErrors(['login' => 'Anda belum login']);
        }

        // Ambil bulan dan tahun dari request, default ke bulan dan tahun saat ini
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Data rekap bulanan berdasarkan bulan dan tahun yang dipilih
        $rekapBulanan = Kegiatan::join('tims', 'kegiatans.id_tim', '=', 'tims.id_tim')
            ->select('tims.nama_tim')
            ->selectRaw('COUNT(kegiatans.id_kegiatan) as total_kegiatan')
            ->selectRaw('SUM(kegiatans.target) as total_target')
            ->selectRaw('SUM(kegiatans.realisasi) as total_realisasi')
            ->whereYear('kegiatans.tanggal_mulai', $tahun)
            ->whereMonth('kegiatans.tanggal_mulai', $bulan)
            ->groupBy('tims.id_tim', 'tims.nama_tim')
            ->get();

        // Filter data sesuai peran pengguna
        switch ($user->id_jabatan) {
            case 1: // Pimpinan
                // Data tidak difilter untuk Pimpinan
                $kegiatanSelesai = Kegiatan::where('status', 'selesai')->count();
                $kegiatanTotal = Kegiatan::count();
                $totalTarget = Kegiatan::sum('target');
                $targetTercapai = Kegiatan::sum('realisasi');

                $kegiatanMendekatiBatasWaktu = Kegiatan::select('nama_kegiatan', 'tanggal_berakhir', 'id_tim')
                    ->where('tanggal_berakhir', '>=', Carbon::now())
                    ->orderBy('tanggal_berakhir', 'asc')
                    ->get()
                    ->map(function ($kegiatan) {
                        $sisaDetik = Carbon::now()->diffInSeconds($kegiatan->tanggal_berakhir);
                        $kegiatan->sisa_hari = ceil($sisaDetik / (24 * 60 * 60));
                        return $kegiatan;
                    })
                    ->filter(function ($kegiatan) {
                        return $kegiatan->sisa_hari <= 10;
                    });

                return view('pimpinan.dashboard', compact(
                    'rekapBulanan',
                    'kegiatanSelesai',
                    'kegiatanTotal',
                    'totalTarget',
                    'targetTercapai',
                    'kegiatanMendekatiBatasWaktu',
                    'bulan',
                    'tahun'
                ));

            case 2: // Penanggung Jawab (PJ)
                // Data hanya difilter untuk tim pengguna
                $kegiatanSelesai = Kegiatan::where('status', 'selesai')
                    ->where('id_tim', $user->id_tim)
                    ->count();
                $kegiatanTotal = Kegiatan::where('id_tim', $user->id_tim)->count();
                $totalTarget = Kegiatan::where('id_tim', $user->id_tim)->sum('target');
                $targetTercapai = Kegiatan::where('id_tim', $user->id_tim)->sum('realisasi');

                $kegiatanMendekatiBatasWaktu = Kegiatan::select('nama_kegiatan', 'tanggal_berakhir', 'id_tim')
                    ->where('tanggal_berakhir', '>=', Carbon::now())
                    ->where('id_tim', $user->id_tim)
                    ->orderBy('tanggal_berakhir', 'asc')
                    ->get()
                    ->map(function ($kegiatan) {
                        $sisaDetik = Carbon::now()->diffInSeconds($kegiatan->tanggal_berakhir);
                        $kegiatan->sisa_hari = ceil($sisaDetik / (24 * 60 * 60));
                        return $kegiatan;
                    })
                    ->filter(function ($kegiatan) {
                        return $kegiatan->sisa_hari <= 10;
                    });

                return view('pj.dashboard', compact(
                    'rekapBulanan',
                    'kegiatanSelesai',
                    'kegiatanTotal',
                    'totalTarget',
                    'targetTercapai',
                    'kegiatanMendekatiBatasWaktu',
                    'bulan',
                    'tahun'
                ));

            case 3: // Anggota
                // Data tidak difilter untuk Anggota
                $kegiatanSelesai = Kegiatan::where('status', 'selesai')->count();
                $kegiatanTotal = Kegiatan::count();
                $totalTarget = Kegiatan::sum('target');
                $targetTercapai = Kegiatan::sum('realisasi');

                $kegiatanMendekatiBatasWaktu = Kegiatan::select('nama_kegiatan', 'tanggal_berakhir', 'id_tim')
                    ->where('tanggal_berakhir', '>=', Carbon::now())
                    ->orderBy('tanggal_berakhir', 'asc')
                    ->get()
                    ->map(function ($kegiatan) {
                        $sisaDetik = Carbon::now()->diffInSeconds($kegiatan->tanggal_berakhir);
                        $kegiatan->sisa_hari = ceil($sisaDetik / (24 * 60 * 60));
                        return $kegiatan;
                    })
                    ->filter(function ($kegiatan) {
                        return $kegiatan->sisa_hari <= 10;
                    });

                return view('anggota.dashboard', compact(
                    'rekapBulanan',
                    'kegiatanSelesai',
                    'kegiatanTotal',
                    'totalTarget',
                    'targetTercapai',
                    'kegiatanMendekatiBatasWaktu',
                    'bulan',
                    'tahun'
                ));

            default:
                return redirect('/login')->withErrors(['id_jabatan' => 'Akses tidak diizinkan']);
        }
    }
}
