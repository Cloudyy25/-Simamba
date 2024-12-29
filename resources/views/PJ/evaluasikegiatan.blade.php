<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Tambah Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="grid lg:grid-cols-[250px_1fr] h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 border-2 bg-white text-orange-500 flex flex-col items-center py-12 px-5 w-64 transform -translate-x-full lg:translate-x-0 lg:relative lg:w-64 lg:h-full transition-transform duration-300 ease-in-out z-50">
            <div class="flex flex-col items-center justify-center mb-10">
                <img src="{{ asset('images/bps.png') }}" alt="BPS Sumbawa" class="w-16 sm:w-24 mb-5 lg:mb-10">
                <h2 class="text-center text-lg sm:text-xl text-black font-bold">
                    Badan Pusat Statistik <br> Kabupaten Sumbawa
                </h2>
            </div>
            <nav class="w-full">
                <ul class="text-center space-y-2">
                    <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                        <a href="{{ route('pj.dashboard') }}" class="block">Dashboard</a>
                    </li>
                    <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                        <a href="{{ route('pjdaftarkegiatan.daftarKegiatan') }}" class="block">Daftar Kegiatan</a>
                    </li>
                    <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">Jadwal Kegiatan
                    </li>
                    <a href="{{ route('pj.evaluasikegiatan') }}">
                        <li class="py-2 lg:py-4 cursor-pointer bg-orange-500 text-white rounded-lg">
                            Evaluasi Kegiatan
                        </li>
                    </a>
                </ul>
            </nav>
            <a href="{{ route('logout') }}" class="mt-auto py-2 px-14 bg-red-600 text-white rounded-lg">Log Out</a>
        </aside>

        <!-- Main Content -->
        <!-- Main Content -->
        <div class="flex flex-col bg-white overflow-y-auto">
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
                        <i class="fa fa-bell"></i>
                        <span class="absolute top-0 right-0 bg-red-600 text-xs text-white rounded-full px-2">3</span>
                    </div>
                </div>
            </header>

            <main class="flex-grow p-6 overflow-y-auto">
                <h2 class="text-4xl font-bold text-orange-500 mb-4 flex justify-between items-center">
                    Evaluasi Kegiatan
                    <div class="flex gap-4">
                        <a href="#belum-dievaluasi">
                            <button id="belum-dievaluasi-tab"
                                class="tab-button border-2 px-3 py-2 rounded-xl text-xl font-normal bg-orange-500 text-white hover:bg-gray-200 focus:outline-none">
                                Belum Dievaluasi
                            </button>
                        </a>
                        <a href="#sudah-dievaluasi">
                            <button id="sudah-dievaluasi-tab"
                                class="tab-button border-2 px-3 py-2 rounded-xl text-xl font-normal bg-orange-500 text-white hover:bg-gray-200 focus:outline-none">
                                Sudah Dievaluasi
                            </button>
                        </a>
                    </div>
                </h2>

                <!-- Daftar Kegiatan Belum Dievaluasi -->
                <section id="belum-dievaluasi" class="mb-6">
                    <h3 class="text-2xl mb-4">Belum Dievaluasi</h3>
                    <div class="border-2 rounded-xl p-6 space-y-4">
                        @forelse ($belumDievaluasi as $item)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <div class="flex justify-between items-center">
                                    <p class="text-lg">{{ $item->nama_kegiatan }}</p>
                                    <button onclick="toggleDetail({{ $item->id_kegiatan }})"
                                        class="text-gray-500 text-xl">
                                        <img id="toggle-icon-{{ $item->id_kegiatan }}"
                                            src="{{ asset('images/add.png') }}" alt="Toggle Detail" class="w-6 h-6" />
                                    </button>
                                </div>

                                <div id="detail-{{ $item->id_kegiatan }}" style="display: none;">
                                    <p>Tanggal Mulai:
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}
                                    </p>
                                    <p>Tanggal Berakhir:
                                        {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->translatedFormat('d M Y') }}
                                    </p>

                                    <!-- Menampilkan Evaluasi tanpa bisa diubah -->
                                    <textarea class="w-full border border-gray-300 rounded-lg mt-2 p-2" readonly>{{ $item->evaluasi ?? '' }}</textarea>
                                </div>
                            </div>
                        @empty
                            <!-- Pesan jika tidak ada data -->
                            <div class="text-center p-4 text-gray-500">Tidak ada data kegiatan yang belum dievaluasi
                                oleh pimpinan</div>
                        @endforelse
                    </div>
                </section>


                <!-- Daftar Kegiatan Sudah Dievaluasi -->
                <section id="sudah-dievaluasi" class="mb-6">
                    <h3 class="text-2xl mb-4">Sudah Dievaluasi</h3>
                    <div class="border-2 rounded-xl p-6 space-y-4">
                        @forelse ($sudahDievaluasi as $item)
                            @if ($item->evaluasis->isNotEmpty())
                                <!-- Tampilkan data kegiatan yang sudah dievaluasi -->
                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                    <div class="flex justify-between items-center">
                                        <p class="text-lg">{{ $item->nama_kegiatan }}</p>
                                        <button onclick="toggleDetail({{ $item->id_kegiatan }})"
                                            class="text-gray-500 text-xl">
                                            <img id="toggle-icon-{{ $item->id_kegiatan }}"
                                                src="{{ asset('images/add.png') }}" alt="Toggle Detail"
                                                class="w-6 h-6" />
                                        </button>
                                    </div>

                                    <div id="detail-{{ $item->id_kegiatan }}" style="display: none;">
                                        <p>Tanggal Mulai:
                                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}
                                        </p>
                                        <p>Tanggal Berakhir:
                                            {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->translatedFormat('d M Y') }}
                                        </p>
                                        <p>Evaluasi:</p>
                                        <div class="border border-gray-300 rounded-lg mt-2 p-4 bg-white">
                                            {{ $item->evaluasis->first()->evaluasi ?? 'Tidak ada evaluasi.' }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <!-- Pesan jika tidak ada data -->
                            <div class="text-center p-4 text-gray-500">Tidak ada data kegiatan yang sudah dievaluasi
                                oleh pimpinan</div>
                        @endforelse
                    </div>
                </section>

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

            function toggleDetail(id) {
                const detailElement = document.getElementById(`detail-${id}`);
                const iconElement = document.getElementById(`toggle-icon-${id}`);

                if (detailElement.style.display === "none" || detailElement.style.display === "") {
                    detailElement.style.display = "block";
                    iconElement.src = "{{ asset('images/minus.png') }}";
                } else {
                    detailElement.style.display = "none";
                    iconElement.src = "{{ asset('images/add.png') }}";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk menampilkan atau menyembunyikan section
                function toggleSection() {
                    const hash = window.location.hash;
                    const belumDievaluasiSection = document.getElementById('belum-dievaluasi');
                    const sudahDievaluasiSection = document.getElementById('sudah-dievaluasi');
                    const belumDievaluasiTab = document.getElementById('belum-dievaluasi-tab');
                    const sudahDievaluasiTab = document.getElementById('sudah-dievaluasi-tab');

                    // Secara default, tampilkan "Belum Dievaluasi"
                    if (!hash) {
                        belumDievaluasiSection.style.display = 'block';
                        sudahDievaluasiSection.style.display = 'none';
                        belumDievaluasiTab.classList.add('bg-gray-500', 'text-white');
                        belumDievaluasiTab.classList.remove('bg-white', 'text-gray-700');
                        sudahDievaluasiTab.classList.remove('bg-gray-500', 'text-white');
                        sudahDievaluasiTab.classList.add('bg-white', 'text-gray-700');
                    } else {
                        document.querySelectorAll('section').forEach(section => {
                            section.style.display = 'none'; // Sembunyikan semua section
                            if (section.id === hash.replace('#', '')) {
                                section.style.display = 'block'; // Tampilkan yang sesuai
                            }
                        });

                        // Mengelola kelas aktif pada tab
                        if (hash === '#belum-dievaluasi') {
                            belumDievaluasiTab.classList.add('bg-gray-500', 'text-white');
                            belumDievaluasiTab.classList.remove('bg-white', 'text-gray-700');
                            sudahDievaluasiTab.classList.remove('bg-gray-500', 'text-white');
                            sudahDievaluasiTab.classList.add('bg-white', 'text-gray-700');
                        } else if (hash === '#sudah-dievaluasi') {
                            sudahDievaluasiTab.classList.add('bg-gray-500', 'text-white');
                            sudahDievaluasiTab.classList.remove('bg-white', 'text-gray-700');
                            belumDievaluasiTab.classList.remove('bg-gray-500', 'text-white');
                            belumDievaluasiTab.classList.add('bg-white', 'text-gray-700');
                        }
                    }
                }

                // Memanggil fungsi ketika halaman dimuat atau hash diubah
                toggleSection();
                window.addEventListener('hashchange', toggleSection);
            });
        </script>
</body>

</html>
