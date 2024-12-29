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
                <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg"><a
                        href="{{ route('pj.dashboard') }}" class="block">Dashboard</a></li>
                <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                    <a href="{{ route('pjdaftarkegiatan.daftarKegiatan') }}" class="block">Daftar Kegiatan</a>
                </li>
                <li class="py-2 lg:py-4 cursor-pointer bg-orange-500 text-white rounded-lg">Jadwal Kegiatan</li>
                <a href="{{ route('pj.evaluasikegiatan') }}">
                    <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                        Evaluasi Kegiatan
                    </li>
                </a>
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
                <span>Penanggung Jawab</span>
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                <div class="relative">
                    <!-- Icon Notifikasi -->
                    <div class="relative cursor-pointer" id="notificationBell">
                        <!-- Ikon Notifikasi (Lonceng) yang lebih besar -->
                        <i class="fa fa-bell text-gray-700 text-3xl"></i>

                        @php
                            // Hitung jumlah notifikasi yang sesuai
                            $jumlahNotifikasi = $kegiatanMendekatiBatasWaktu
                                ->filter(function ($kegiatan) {
                                    return $kegiatan->id_tim == auth()->user()->id_tim;
                                })
                                ->count();
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
                                @if ($kegiatan->id_tim == auth()->user()->id_tim)
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
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </header>

        <main class="flex-grow p-6 overflow-y-auto">

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
    </script>
</body>

</html>
