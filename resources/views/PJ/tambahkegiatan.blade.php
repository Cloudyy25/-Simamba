<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Tambah Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <li class="py-2 lg:py-4 cursor-pointer bg-orange-500 text-white rounded-lg">
                        <a href="{{ route('pjdaftarkegiatan.daftarKegiatan') }}" class="block">Daftar Kegiatan</a>
                    </li>
                    <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">Jadwal Kegiatan
                    </li>
                    <a href="{{ route('pj.evaluasikegiatan') }}">
                        <li class="py-2 lg:py-4 cursor-pointer hover:bg-orange-300 transition rounded-lg">
                            Evaluasi Kegiatan
                        </li>
                    </a>
                </ul>
            </nav>
            <a href="{{ route('logout') }}" class="mt-auto py-2 px-14 bg-red-600 text-white rounded-lg">Log Out</a>
        </aside>

        <!-- Main Content -->
        <!-- Main Content -->
        <div class="flex flex-col overflow-y-auto">
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

            <main class="flex-grow p-6 overflow-y-auto  bg-white">
                <h2 class="text-4xl font-bold mb-4 flex justify-between items-center">
                    Tambah Kegiatan
                    <div class="flex gap-4">
                        <a href="{{ route('pjdaftarkegiatan.daftarKegiatan') }}">
                            <button
                                class="tab-button border-2 px-4 py-2 rounded-xl text-xl font-normal bg-orange-500 text-white hover:bg-gray-200 focus:outline-none">
                                Kembali
                            </button>
                        </a>
                    </div>
                </h2>

                <div class="border-2 border-orange-500 rounded-xl p-6 mb-6">

                    <!-- Menampilkan pesan sukses -->
                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: '{{ session('success') }}',
                                    background: 'linear-gradient(to bottom, #FFC94A, #FFB43A)',
                                    confirmButtonColor: '#28A745',
                                    confirmButtonText: 'OK',
                                    imageUrl: "{{ asset('images/exclamation.png') }}",
                                    imageWidth: 100,
                                    imageHeight: 100,
                                    imageAlt: 'Success Icon',
                                    customClass: {
                                        popup: 'w-96 h-60 rounded-lg bg-gradient-to-b from-green-400 to-green-500 p-4 shadow-xl',
                                        title: 'text-white text-lg font-semibold',
                                        content: 'text-white text-sm',
                                        confirmButton: 'bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 transition duration-200',
                                        icon: 'bg-green-400 text-black rounded-full'
                                    }
                                });
                            });
                        </script>
                    @endif

                    <form action="{{ route('kegiatan.store') }}" method="POST" onsubmit="validateAndSubmit(event)">
                        @csrf
                        <!-- Input Nama Kegiatan -->
                        <div class="mb-4">
                            <label for="nama_kegiatan" class="block text-sm font-medium">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                class="border p-2 w-full @error('nama_kegiatan') border-red-500 @enderror"
                                value="{{ old('nama_kegiatan') }}" required>
                            @error('nama_kegiatan')
                                <div class="text-red-500 text-sm mt-1"></div>
                            @enderror
                        </div>

                        <!-- Input Nama Tim -->
                        <div class="mb-4">
                            <label for="nama_tim" class="block text-sm font-medium">Nama Tim</label>
                            <input type="text" name="nama_tim" id="nama_tim"
                                class="border p-2 w-full @error('nama_tim') border-red-500 @enderror"
                                value="{{ auth()->user()->tim->nama_tim }}" readonly required>
                            @error('nama_tim')
                                <div class="text-red-500 text-sm mt-1"></div>
                            @enderror
                        </div>

                        <!-- Input Tanggal Mulai -->
                        <div class="mb-4">
                            <label for="mulai" class="block text-sm font-medium">Tanggal Mulai</label>
                            <input type="date" name="mulai" id="mulai"
                                class="border p-2 w-full @error('mulai') border-red-500 @enderror"
                                value="{{ old('mulai') }}" required>
                            @error('mulai')
                                <div class="text-red-500 text-sm mt-1"></div>
                            @enderror
                        </div>

                        <!-- Input Tanggal Berakhir -->
                        <div class="mb-4">
                            <label for="berakhir" class="block text-sm font-medium">Tanggal Berakhir</label>
                            <input type="date" name="berakhir" id="berakhir"
                                class="border p-2 w-full @error('berakhir') border-red-500 @enderror"
                                value="{{ old('berakhir') }}" required>
                            @error('berakhir')
                                <div class="text-red-500 text-sm mt-1">Tanggal berakhir harus sesudah tanggal mulai</div>
                            @enderror
                        </div>

                        <!-- Input Target -->
                        <div class="mb-4">
                            <label for="target" class="block text-sm font-medium">Target</label>
                            <input type="number" name="target" id="target"
                                class="border p-2 w-full @error('target') border-red-500 @enderror"
                                value="{{ old('target') }}" required>
                            @error('target')
                                <div class="text-red-500 text-sm mt-1">Target tidak boleh 0</div>
                            @enderror
                        </div>

                        <!-- Input Realisasi -->
                        <div class="mb-4">
                            <label for="realisasi" class="block text-sm font-medium">Realisasi</label>
                            <input type="number" name="realisasi" id="realisasi"
                                class="border p-2 w-full @error('realisasi') border-red-500 @enderror"
                                value="{{ old('realisasi') }}" required>
                            @error('realisasi')
                                <div class="text-red-500 text-sm mt-1">Jumlah realisasi melebihi target</div>
                            @enderror
                        </div>

                        <!-- Input Satuan -->
                        <div class="mb-4">
                            <label for="satuan" class="block text-sm font-medium">Satuan</label>
                            <input type="text" name="satuan" id="satuan"
                                class="border p-2 w-full @error('satuan') border-red-500 @enderror"
                                value="{{ old('satuan') }}" required>
                            @error('satuan')
                                <div class="text-red-500 text-sm mt-1"></div>
                            @enderror
                        </div>

                        <!-- Input Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium">Status</label>
                            <select name="status" id="status" class="border p-2 w-full" required>
                                <option value="1">Belum Selesai</option>
                                <option value="0">Selesai</option>
                            </select>
                            @error('status')
                                <div class="text-red-500 text-sm mt-1"></div>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded">Simpan
                            Kegiatan</button>
                    </form>




            </main>
            <footer class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 sm:px-6 py-4 mt-auto">
                <div class="max-w-screen-lg mx-auto">
                    <div class="text-sm sm:text-lg font-medium">
                        © 2024 <span class="text-green-500">Tim Pengolahan dan TI</span> Badan Pusat Statistik
                    </div>
                </div>
            </footer>
        </div>
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

        function validateAndSubmit(event) {
            event.preventDefault(); // Prevent default form submission

            // Ambil nilai input
            const mulai = document.getElementById('mulai').value;
            const berakhir = document.getElementById('berakhir').value;
            const target = document.getElementById('target').value;
            const realisasi = document.getElementById('realisasi').value;

            // Validasi tanggal
            if (new Date(berakhir) <= new Date(mulai)) {
                Swal.fire({
                    title: 'Tanggal berakhir harus setelah tanggal mulai.',
                    background: 'linear-gradient(to bottom, #FFC94A, #FFB43A)', // Background gradient
                    confirmButtonColor: '#E63946', // Warna tombol error
                    confirmButtonText: 'OK',
                    imageUrl: "{{ asset('images/failed.png') }}", // Gambar sukses
                    imageWidth: 100,
                    imageHeight: 100,
                    customClass: {
                        popup: 'w-96 h-60 rounded-lg bg-gradient-to-b from-green-400 to-green-500 p-4 shadow-xl',
                        title: 'text-white text-lg font-semibold',
                        content: 'text-white text-sm',
                        confirmButton: 'bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 transition duration-200',
                        icon: 'bg-green-400 text-black rounded-full'
                    }
                });
                return;
            }

            // Validasi target dan realisasi
            if (parseInt(realisasi) > parseInt(target)) {
                Swal.fire({
                    title: 'Realisasi tidak boleh lebih besar dari target.',
                    background: 'linear-gradient(to bottom, #FFC94A, #FFB43A)', // Background gradient
                    confirmButtonColor: '#E63946', // Warna tombol error
                    confirmButtonText: 'OK',
                    imageUrl: "{{ asset('images/failed.png') }}", // Gambar sukses
                    imageWidth: 100,
                    imageHeight: 100,
                    customClass: {
                        popup: 'w-96 h-60 rounded-lg bg-gradient-to-b from-green-400 to-green-500 p-4 shadow-xl',
                        title: 'text-white text-lg font-semibold',
                        content: 'text-white text-sm',
                        confirmButton: 'bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 transition duration-200',
                        icon: 'bg-green-400 text-black rounded-full'
                    }
                });
                return;
            }

            // Jika validasi berhasil, lanjutkan ke konfirmasi
            Swal.fire({
                title: 'Kegiatan berhasil ditambahkan!',
                background: 'linear-gradient(to bottom, #FFC94A, #FFB43A)',
                confirmButtonColor: '#28A745', // Warna tombol konfirmasi
                confirmButtonText: 'OK',
                imageUrl: "{{ asset('images/exclamation.png') }}", // Gambar sukses
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'Success Icon', // Alt text untuk gambar
                customClass: {
                    popup: 'w-96 h-60 rounded-lg bg-gradient-to-b from-green-400 to-green-500 p-4 shadow-xl',
                    title: 'text-white text-lg font-semibold',
                    content: 'text-white text-sm',
                    confirmButton: 'bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 transition duration-200',
                    icon: 'bg-green-400 text-black rounded-full'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
</body>

</html>
