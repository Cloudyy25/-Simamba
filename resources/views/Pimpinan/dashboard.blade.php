<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Monitoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex flex-row h-screen">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 bg-white text-orange-500 flex flex-col items-center py-12 px-5 w-64 transform lg:translate-x-0 lg:relative lg:w-64 lg:h-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex flex-col items-center justify-center mb-10">
            <img src="{{ asset('images/bps.png') }}" alt="BPS Sumbawa" class="w-16 sm:w-24 mb-5 lg:mb-10">
            <h2 class="text-center text-lg sm:text-xl text-black font-bold">
                Badan Pusat Statistik <br> Kabupaten Sumbawa
            </h2>
        </div>
        <nav class="w-full">
            <ul class="text-center space-y-2">
                <li class="py-2 lg:py-4 cursor-pointer bg-orange-500 text-white rounded-lg">
                    <a href="{{ route('pimpinan.dashboard') }}" class="block">Dashboard</a>
                </li>
                <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                    <a href="{{ route('pimpinandaftarkegiatan.daftarKegiatan') }}" class="block">Daftar Kegiatan</a>
                </li>
                <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                    <a href="{{ route('pimpinan.jadwalkegiatan') }}" class="block">Jadwal Kegiatan</a>
                </li>
                <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                    <a href="{{ route('pimpinan.evaluasikegiatan') }}" class="block">Evaluasi Kegiatan</a>
                </li>
            </ul>
        </nav>
        <a href="{{ route('logout') }}" class="mt-auto py-2 px-14 bg-red-600 text-white rounded-lg">Log Out</a>
    </aside>


    <!-- Konten Utama -->
    <div class="flex flex-col flex-grow h-full">
        <header
            class="flex justify-between items-center bg-gradient-to-r from-yellow-400 to-orange-400 px-5 py-2 h-16 text-white">
            <!-- Hamburger Icon -->
            <div id="hamburger" class="z-50 cursor-pointer lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold">Sistem Monitoring</h1>
            <div class="flex items-center gap-3">
                <span>Pimpinan</span>
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                <div class="relative">
                    <!-- Icon Notifikasi -->
                    <div class="relative cursor-pointer" id="notificationBell">
                        <!-- Ikon Notifikasi (Lonceng) yang lebih besar -->
                        <i class="fa fa-bell text-gray-700 text-3xl"></i>

                        @php
                            // Hitung jumlah notifikasi secara keseluruhan
                            $jumlahNotifikasi = $kegiatanMendekatiBatasWaktu->count();
                        @endphp

                        @if ($jumlahNotifikasi > 0)
                            <!-- Tampilkan badge dengan ukuran lebih kecil jika ada notifikasi -->
                            <span
                                class="absolute top-0 right-0 bg-red-600 text-xs text-white rounded-full px-1 py-0.5">{{ $jumlahNotifikasi }}</span>
                        @endif
                    </div>

                    <!-- Notifikasi Dropdown -->
                    <div id="notificationDropdown"
                        class="fixed top-16 right-8 w-96 bg-gradient-to-br from-white to-gray-100 p-4 rounded-xl shadow-xl z-50 hidden transition-transform transform scale-95 hover:scale-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Notifikasi</h3>
                            <button id="closeNotification" class="text-gray-500 hover:text-gray-700">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>

                        <ul class="space-y-4">
                            @foreach ($kegiatanMendekatiBatasWaktu as $kegiatan)
                                <li
                                    class="p-4 bg-white rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition-all">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-8 h-8 bg-orange-600 text-white font-bold flex items-center justify-center rounded-full">
                                            {{ $loop->iteration }}
                                        </div>
                                        <span
                                            class="text-lg font-semibold text-gray-700">{{ $kegiatan->nama_kegiatan }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-orange-600">{{ $kegiatan->sisa_hari }}
                                        Hari</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </header>

        <main class="flex-grow p-6 overflow-y-auto">
            <h2 class="text-4xl font-bold text-orange-500 mb-6">Dashboard</h2>
            <div class=" p-6 space-y-6">
                <!-- Kegiatan Selesai -->
                <div
                    class="flex items-center justify-between bg-gradient-to-r from-green-400 to-blue-500 p-6 rounded-lg shadow-lg transform transition hover:scale-105">
                    <div class="flex-1 px-4 text-white">
                        <h2 class="text-3xl font-extrabold text-center">Kegiatan Selesai</h2>
                        <div class="text-5xl font-medium text-center mt-4">
                            <span class="text-7xl font-bold">{{ $kegiatanSelesai }}</span>
                            <span class="text-3xl">/ {{ $kegiatanTotal }}</span>
                        </div>
                    </div>
                    <div class="relative w-32 h-32">
                        <svg class="transform -rotate-90" width="100%" height="100%" viewBox="0 0 36 36">
                            <!-- Background Circle -->
                            <circle class="text-gray-300" stroke="currentColor" stroke-width="4" fill="none"
                                cx="18" cy="18" r="16" stroke-dasharray="100,100"></circle>
                            <!-- Progress Circle -->
                            <circle class="text-white" stroke="currentColor" stroke-width="4" fill="none"
                                cx="18" cy="18" r="16"
                                stroke-dasharray="{{ $kegiatanTotal > 0 ? ($kegiatanSelesai / $kegiatanTotal) * 100 : 0 }},100"
                                stroke-linecap="round">
                            </circle>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center text-xl font-bold text-white">
                            {{ $kegiatanTotal > 0 ? round(($kegiatanSelesai / $kegiatanTotal) * 100) : 0 }}%
                        </div>
                    </div>
                </div>

                <!-- Target Tercapai -->
                <div
                    class="flex items-center justify-between bg-gradient-to-r from-yellow-400 to-red-500 p-6 rounded-lg shadow-lg transform transition hover:scale-105">
                    <div class="flex-1 px-4 text-white">
                        <h2 class="text-3xl font-extrabold text-center">Target Tercapai</h2>
                        <div class="text-5xl font-medium text-center mt-4">
                            <span class="text-7xl font-bold">{{ $targetTercapai }}</span>
                            <span class="text-3xl">/ {{ $totalTarget }}</span>
                        </div>
                    </div>
                    <div class="relative w-32 h-32">
                        <svg class="transform -rotate-90" width="100%" height="100%" viewBox="0 0 36 36">
                            <!-- Background Circle -->
                            <circle class="text-gray-300" stroke="currentColor" stroke-width="4" fill="none"
                                cx="18" cy="18" r="16" stroke-dasharray="100,100"></circle>
                            <!-- Progress Circle -->
                            <circle class="text-white" stroke="currentColor" stroke-width="4" fill="none"
                                cx="18" cy="18" r="16"
                                stroke-dasharray="{{ $totalTarget > 0 ? ($targetTercapai / $totalTarget) * 100 : 0 }},100"
                                stroke-linecap="round">
                            </circle>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center text-xl font-bold text-white">
                            {{ $totalTarget > 0 ? round(($targetTercapai / $totalTarget) * 100) : 0 }}%
                        </div>
                    </div>
                </div>


                <!-- Rekap Kegiatan Bulanan -->
                <div
                    class="bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 p-8 rounded-xl shadow-lg text-white transform transition hover:scale-105">
                    <h2 class="text-3xl font-extrabold text-center mb-8">
                        Rekap Kegiatan Seluruh Tim Bulan
                        <span class="underline decoration-yellow-400">
                            {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
                        </span>
                    </h2>


                    <!-- Form Filter Bulan dan Tahun -->
                    <form method="GET" action="{{ url()->current() }}"
                        class="flex justify-center items-center mb-6 gap-4">
                        <select name="bulan" class="bg-white text-gray-800 border border-gray-300 rounded-lg p-2">
                            @foreach (range(1, 12) as $i)
                                <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::createFromDate(null, $i, 1)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        <select name="tahun" class="bg-white text-gray-800 border border-gray-300 rounded-lg p-2">
                            @foreach (range(\Carbon\Carbon::now()->year - 5, \Carbon\Carbon::now()->year + 1) as $year)
                                <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg px-6 py-2 transition">
                            Tampilkan
                        </button>
                    </form>

                    <!-- Tabel Rekap -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left bg-white text-gray-800 rounded-lg overflow-hidden shadow-md">
                            <thead class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white">
                                <tr>
                                    <th class="border-b-2 p-4 text-center">Tim Kerja</th>
                                    <th class="border-b-2 p-4 text-center">Total Kegiatan</th>
                                    <th class="border-b-2 p-4 text-center">Total Target</th>
                                    <th class="border-b-2 p-4 text-center">Total Diterima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rekapBulanan as $rekap)
                                    <tr class="hover:bg-gray-100">
                                        <td class="p-4 border-b text-center font-medium">
                                            {{ $rekap->nama_tim ?? 'No Team' }}</td>
                                        <td class="p-4 border-b text-center">{{ $rekap->total_kegiatan ?? 0 }}</td>
                                        <td class="p-4 border-b text-center">{{ $rekap->total_target ?? 0 }}</td>
                                        <td class="p-4 border-b text-center">{{ $rekap->total_realisasi ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 border-b text-center text-gray-500">Data tidak
                                            tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>



                <!-- Kegiatan Mendekati Batas Waktu -->
                <div
                    class="bg-gradient-to-r from-yellow-400 to-orange-500 p-8 rounded-xl shadow-lg text-white transform transition hover:scale-105">
                    <h2 class="text-3xl font-extrabold text-center mb-8">
                        Kegiatan Mendekati Batas Waktu
                    </h2>

                    @if ($kegiatanMendekatiBatasWaktu->isEmpty())
                        <p class="text-center text-lg font-medium text-gray-700">
                            Tidak ada kegiatan yang mendekati batas waktu.
                        </p>
                    @else
                        <ul class="space-y-6">
                            @foreach ($kegiatanMendekatiBatasWaktu as $kegiatan)
                                <li
                                    class="p-4 bg-white shadow-md rounded-lg transition-transform transform hover:scale-105 hover:shadow-lg">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-8 h-8 bg-orange-600 text-white font-bold flex items-center justify-center rounded-full">
                                                {{ $loop->iteration }}
                                            </div>
                                            <span
                                                class="text-lg font-semibold text-gray-700">{{ $kegiatan->nama_kegiatan }}</span>
                                        </div>
                                        <span class="text-sm font-medium text-orange-600">{{ $kegiatan->sisa_hari }}
                                            Hari</span>
                                    </div>
                                    <div class="h-4 bg-gray-200 rounded-full mt-4 relative">
                                        <div class="h-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"
                                            style="width: {{ 100 - ($kegiatan->sisa_hari / 10) * 100 }}%;"></div>
                                        <span
                                            class="absolute right-2 top-0 text-xs text-gray-500">{{ 100 - ($kegiatan->sisa_hari / 10) * 100 }}%</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>




            </div>
        </main>

        <footer class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 sm:px-6 py-4 mt-auto">
            <div class="max-w-screen-lg mx-auto">
                <div class="text-sm sm:text-lg font-medium">
                    © 2024 <span class="text-green-500">Tim Pengolahan dan TI</span> Badan Pusat Statistik
                </div>
            </div>
        </footer>
    </div>
    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        // Menyembunyikan sidebar saat ukuran layar kecil (misalnya, 768px)
        const hideSidebarOnResize = () => {
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full'); // Menyembunyikan sidebar
            } else {
                sidebar.classList.remove('-translate-x-full'); // Menampilkan sidebar
            }
        };

        // Menambahkan event listener untuk klik hamburger
        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Menambahkan event listener untuk resize window
        window.addEventListener('resize', hideSidebarOnResize);

        // Panggil fungsi untuk memastikan sidebar tersembunyi saat pertama kali dimuat (pada ukuran kecil)
        hideSidebarOnResize();

        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: '<h2 class="text-3xl font-extrabold text-gray-800">Kegiatan Mendekati Batas Waktu</h2>',
                html: `
                <div class="bg-gradient-to-br from-white to-gray-100 p-6 rounded-xl shadow-lg">
                    <ul class="space-y-6">
                        @foreach ($kegiatanMendekatiBatasWaktu as $kegiatan)
                            <li class="p-4 bg-white rounded-lg shadow-md flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="w-8 h-8 bg-orange-600 text-white font-bold flex items-center justify-center rounded-full">
                                        {{ $loop->iteration }}
                                    </div>
                                    <span class="text-lg font-semibold text-gray-700">{{ $kegiatan->nama_kegiatan }}</span>
                                </div>
                                <span class="text-sm font-medium text-orange-600">{{ $kegiatan->sisa_hari }} Hari</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            `,
                width: 700,
                padding: '2em',
                color: '#1a202c',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#f97316',
            });
        });
    </script>
</body>

</html>
