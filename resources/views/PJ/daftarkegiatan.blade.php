<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>Sistem Monitoring Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tambahkan Library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="flex flex-col lg:flex-row min-h-screen">
    <div class="flex flex-col lg:grid lg:grid-cols-[250px_1fr] h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 border-2 bg-white text-orange-500 flex flex-col items-center py-12 px-5 w-64 transform lg:translate-x-0 lg:relative lg:w-64 lg:h-full transition-transform duration-300 ease-in-out">
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


            <main class="flex-grow p-6 overflow-y-auto">
                <h2 class="text-4xl font-bold text-orange-500 mb-6">Kegiatan</h2>

                <div class="border-2 border-orange-500 rounded-xl p-6 mb-6">
                    <div class="flex flex-wrap gap-6 items-center justify-between w-full">
                        <!-- Dropdown dan Tombol -->
                        <div class="flex flex-wrap gap-4 items-center">
                            <!-- Dropdown dan Tombol Filter -->
                            <form action="{{ route('pjdaftarkegiatan.daftarKegiatan') }}" method="GET"
                                class="flex flex-wrap gap-4 items-center">
                                <span class="py-2 px-4 font-bold text-xl text-orange-500">Filter</span>

                                <!-- Dropdown Bulan -->
                                <select name="month"
                                    class="py-2 px-2 text-lg border border-gray-300 rounded-md w-full sm:w-40">
                                    <option value="">Pilih Bulan</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}"
                                            {{ request('month') == $month ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Dropdown Tahun -->
                                <select name="year"
                                    class="py-2 px-2 text-lg border border-gray-300 rounded-md w-full sm:w-40">
                                    <option value="">Pilih Tahun</option>
                                    @foreach (range(date('Y'), date('Y') - 5) as $year)
                                        <option value="{{ $year }}"
                                            {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Tombol Filter -->
                                <button type="submit"
                                    class="py-2 px-4 bg-orange-500 text-white text-lg rounded-md w-full sm:w-40">
                                    Filter
                                </button>
                            </form>
                        </div>

                        <!-- Tombol Tambah Kegiatan -->
                        <div class="flex gap-4 items-center w-full sm:w-auto ">
                            <a href="{{ route('pjdaftarkegiatan.create') }}" class=" block w-full sm:w-48">
                                <button class="py-2 px-4 bg-green-500 text-white text-lg rounded-md w-full">
                                    Tambah Kegiatan
                                </button>
                            </a>
                        </div>

                        <div class="flex flex-wrap gap-6 items-center justify-between w-full">
                            <!-- Tombol Ekspor (Excel, CSV, Print) - Rata Kiri -->
                            <div class="flex gap-4 items-center w-full sm:w-auto mb-4">
                                <!-- Tombol Excel -->
                                <a href="{{ route('pjdaftarkegiatan.download', ['format' => 'excel']) }}"
                                    class="flex justify-center items-center py-2 px-4 bg-green-500 text-white text-lg rounded-md w-full sm:w-40">Excel</a>

                                <!-- Tombol CSV -->
                                <a href="{{ route('pjdaftarkegiatan.download', ['format' => 'csv']) }}"
                                    class="flex justify-center items-center py-2 px-4 bg-green-500 text-white text-lg rounded-md w-full sm:w-40">CSV</a>

                                <!-- Tombol Print -->
                                <a href="{{ route('pjdaftarkegiatan.print') }}" target="_blank"
                                    class="flex justify-center items-center py-2 px-4 bg-green-500 text-white text-lg rounded-md w-full sm:w-40">Print</a>
                            </div>

                            <!-- Pencarian -->
                            <div class="flex gap-4 items-center w-full sm:w-auto mb-4">
                                <span class="font-bold text-xl text-orange-500">Search:</span>
                                <input type="text"
                                    class="py-2 px-4 text-lg border-2 border-orange-500 rounded-md w-full sm:w-48"
                                    placeholder="Pencarian" oninput="handleSearch(event)" />
                            </div>
                        </div>



                    </div>

                    <div class="overflow-x-auto">
                        <!-- In the view (pj.daftarkegiatan.blade.php) -->
                        <table class="w-full table-auto border-collapse mt-4" style="table-layout: fixed;">
                            <thead>
                                <tr class="text-center border-b border-orange-500 ">
                                    <th class="p-2 text-center border border-orange-500" style="width: 40px;">No</th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 280px;">Kegiatan
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 150px;">Tim Kerja
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 140px;">Mulai
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 140px;">
                                        Berakhir
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 90px;">Target
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 90px;">
                                        Realisasi</th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 80px;">Satuan
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 70px;">Status
                                    </th>
                                    <th class="p-2 text-center border border-orange-500" style="width: 80px;">Opsi
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="kegiatan-table-body">
                                @forelse ($kegiatan as $item)
                                    <tr class="border-b border-orange-500  text-sm">
                                        <td rowspan="2" class="text-center p-2 border border-orange-500">
                                            {{ $kegiatan->firstItem() + $loop->index }}
                                        </td>
                                        <td rowspan="2" class="p-2 border border-orange-500">
                                            {{ $item->nama_kegiatan }}
                                        </td>
                                        <td rowspan="2" class="text-center p-2 border border-orange-500">
                                            {{ $item->tim->nama_tim ?? 'Tidak Ada Tim' }}
                                        </td>
                                        <td class="text-center p-2 border border-orange-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('j F Y') }}
                                        </td>
                                        <td class="text-center p-2 border border-orange-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->format('j F Y') }}
                                        </td>
                                        <td class="text-center p-2 border border-orange-500">{{ $item->target }}</td>
                                        <td class="text-center p-2 border border-orange-500">{{ $item->realisasi }}
                                        </td>
                                        <td rowspan="2" class=" text-center p-2 border border-orange-500">
                                            {{ $item->satuan }}
                                        </td>
                                        <td rowspan="2" class="text-center p-2 border border-orange-500">
                                            {{ $item->status == 0 ? 'Selesai' : 'Belum Selesai' }}
                                        </td>

                                        <td rowspan="2" class="text-center p-2 border border-orange-500">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('pjdaftarkegiatan.edit', ['kegiatan' => $item->id_kegiatan]) }}"
                                                class="inline-block mr-2">
                                                <img src="{{ asset('images/edit.png') }}" alt="Edit"
                                                    class="w-6 h-6 inline hover:opacity-80">
                                            </a>

                                            <!-- Tombol Delete -->
                                            <form id="delete-form-{{ $item->id_kegiatan }}"
                                                action="{{ route('pjdaftarkegiatan.destroy', $item->id_kegiatan) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" onclick="confirmDelete({{ $item->id_kegiatan }})"
                                                class="hover:opacity-80">
                                                <img src="{{ asset('images/delete.png') }}" alt="Delete"
                                                    class="w-6 h-6 inline">
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- Progress bar untuk durasi -->
                                        <td colspan="2" class="p-2 border-b border-orange-500"
                                            style="padding-left: 20px; padding-right: 20px;">
                                            <div class="w-full bg-gray-200 rounded-full h-4 relative">
                                                <div class="bg-green-500 h-4 rounded-full flex items-center justify-center text-xs font-bold text-black"
                                                    style="width: {{ $item->duration_progress }}%;">
                                                    {{ $item->duration_progress }}%
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Progress bar untuk target/realisasi -->
                                        <td colspan="2" class="p-2 border-b border-l border-orange-500"
                                            style="padding-left: 20px; padding-right: 20px;">
                                            <div class="w-full bg-gray-200 rounded-full h-4 relative">
                                                <div class="bg-green-500 h-4 rounded-full flex items-center justify-center text-xs font-bold text-black"
                                                    style="width: {{ $item->target_progress }}%;">
                                                    {{ $item->target_progress }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center p-4 text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tr id="no-data-row" style="display: none;">
                                <td colspan="10" style="text-align: center;">Tidak ada kegiatan yang ditemukan</td>
                            </tr>
                        </table>





                        <div class="flex justify-between items-center mt-6">
                            <div id="pagination-text" class="text-gray-700">
                                Showing {{ $kegiatan->firstItem() }} to {{ $kegiatan->lastItem() }} of
                                {{ $kegiatan->total() }} entries
                            </div>

                            <div class="flex items-center gap-2">
                                <!-- Tombol Previous -->
                                @if ($kegiatan->onFirstPage())
                                    <button
                                        class="py-2 px-4 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">Previous</button>
                                @else
                                    <a href="{{ $kegiatan->previousPageUrl() }}"
                                        class="py-2 px-4 bg-orange-500 text-white rounded-md">Previous</a>
                                @endif

                                <!-- Nomor Halaman -->
                                @for ($i = 1; $i <= $kegiatan->lastPage(); $i++)
                                    @if ($i == $kegiatan->currentPage())
                                        <span
                                            class="py-2 px-4 bg-orange-500 text-white rounded-md">{{ $i }}</span>
                                    @else
                                        <a href="{{ $kegiatan->url($i) }}"
                                            class="py-2 px-4 rounded-md hover:bg-orange-500 hover:text-white">{{ $i }}</a>
                                    @endif
                                @endfor

                                <!-- Tombol Next -->
                                @if ($kegiatan->hasMorePages())
                                    <a href="{{ $kegiatan->nextPageUrl() }}"
                                        class="py-2 px-4 bg-orange-500 text-white rounded-md">Next</a>
                                @else
                                    <button
                                        class="py-2 px-4 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">Next</button>
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

        function handleSearch(event) {
            const query = event.target.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#kegiatan-table-body tr');
            const paginationText = document.getElementById('pagination-text');
            const paginationControls = document.querySelector('.flex.items-center.gap-2');
            const noDataRow = document.getElementById('no-data-row'); // Baris khusus untuk pesan "Tidak ada kegiatan"

            const entriesPerPage = 30; // Jumlah data per halaman

            if (query === '') {
                // Reset semua baris dan pagination jika tidak ada query
                rows.forEach(row => row.style.display = '');
                paginationText.textContent =
                    `Showing {{ $kegiatan->firstItem() }} to {{ $kegiatan->lastItem() }} of {{ $kegiatan->total() }} entries`;
                paginationControls.style.display = ''; // Tampilkan pagination
                noDataRow.style.display = 'none'; // Sembunyikan pesan "Tidak ada data"
                return;
            }

            let currentNumber = 1;
            let visibleCount = 0;

            // Iterasi setiap baris (mengelompokkan dua baris terkait jika perlu)
            const filteredRows = [];
            for (let i = 0; i < rows.length; i += 2) {
                const rowMain = rows[i];
                const rowProgress = rows[i + 1];

                const cells = rowMain.querySelectorAll('td');
                const isMatch = Array.from(cells).some(cell =>
                    cell.textContent.toLowerCase().includes(query)
                );

                if (isMatch) {
                    filteredRows.push({
                        rowMain,
                        rowProgress
                    });
                    visibleCount++;
                } else {
                    rowMain.style.display = 'none';
                    if (rowProgress) rowProgress.style.display = 'none';
                }
            }

            // Tampilkan data berdasarkan halaman
            const totalPages = Math.ceil(visibleCount / entriesPerPage);
            const currentPage = 1; // Halaman awal
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;

            filteredRows.forEach((row, index) => {
                if (index >= start && index < end) {
                    row.rowMain.style.display = '';
                    row.rowMain.querySelector('td:nth-child(1)').textContent = currentNumber++;
                    if (row.rowProgress) row.rowProgress.style.display = '';
                } else {
                    row.rowMain.style.display = 'none';
                    if (row.rowProgress) row.rowProgress.style.display = 'none';
                }
            });

            // Update teks pagination dan tampilkan/hide pesan "Tidak ada data"
            if (visibleCount === 0) {
                paginationText.textContent =
                    `Showing 0 to 0 of 0 entries (filtered from {{ $kegiatan->total() }} total entries)`;
                paginationControls.style.display = 'none';
                noDataRow.style.display = ''; // Tampilkan pesan "Tidak ada kegiatan"
            } else {
                paginationText.textContent =
                    `Showing 1 to ${Math.min(entriesPerPage, visibleCount)} of ${visibleCount} entries (filtered from {{ $kegiatan->total() }} total entries)`;
                paginationControls.style.display = ''; // Tampilkan pagination jika data > 30
                noDataRow.style.display = 'none'; // Sembunyikan pesan "Tidak ada kegiatan"
            }

            // Tambahkan logika untuk tombol Previous dan Next di pagination
            updatePaginationControls(totalPages, currentPage);
        }


        function updatePaginationControls(totalPages, currentPage) {
            const paginationControls = document.querySelector('.flex.items-center.gap-2');

            // Hapus tombol sebelumnya
            paginationControls.innerHTML = '';

            // Tambahkan tombol Previous
            const prevButton = document.createElement('button');
            prevButton.textContent = 'Previous';
            prevButton.className = currentPage === 1 ?
                'py-2 px-4 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed' :
                'py-2 px-4 bg-orange-500 text-white rounded-md';
            if (currentPage > 1) {
                prevButton.addEventListener('click', () => goToPage(currentPage - 1));
            }
            paginationControls.appendChild(prevButton);

            // Tambahkan nomor halaman
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = i === currentPage ?
                    'py-2 px-4 bg-orange-500 text-white rounded-md' :
                    'py-2 px-4 rounded-md hover:bg-orange-500 hover:text-white';
                if (i !== currentPage) {
                    pageButton.addEventListener('click', () => goToPage(i));
                }
                paginationControls.appendChild(pageButton);
            }

            // Tambahkan tombol Next
            const nextButton = document.createElement('button');
            nextButton.textContent = 'Next';
            nextButton.className = currentPage === totalPages ?
                'py-2 px-4 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed' :
                'py-2 px-4 bg-orange-500 text-white rounded-md';
            if (currentPage < totalPages) {
                nextButton.addEventListener('click', () => goToPage(currentPage + 1));
            }
            paginationControls.appendChild(nextButton);
        }

        function goToPage(pageNumber) {
            // Logika untuk berpindah halaman
            handleSearch({
                target: {
                    value: document.querySelector('#search-input').value.trim()
                }
            }, pageNumber);
        }



        function confirmDelete(id) {
            console.log("Fungsi confirmDelete dipanggil dengan ID:", id); // Debug
            Swal.fire({
                title: 'Anda yakin akan menghapus?',
                background: 'linear-gradient(to bottom, #FFC94A, #FFB43A)', // Warna gradasi oranye
                showCancelButton: true,
                confirmButtonColor: '#28A745', // Warna hijau (Ya)
                cancelButtonColor: '#DC3545', // Warna merah (Tidak)
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                imageUrl: "{{ asset('images/exclamation.png') }}", // Gambar kustom sebagai ikon
                imageWidth: 100, // Menyesuaikan ukuran gambar
                imageHeight: 100, // Menyesuaikan ukuran gambar
                imageAlt: 'Custom icon', // Alt text untuk gambar
                customClass: {
                    popup: 'w-30px h-30px rounded-lg bg-gradient-to-b from-yellow-400 to-yellow-500 p-4 shadow-xl',
                    title: 'text-white text-lg font-semibold', // Ukuran teks judul lebih kecil
                    content: 'text-white text-xs', // Ukuran teks konten lebih kecil
                    confirmButton: 'bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 transition duration-200',
                    cancelButton: 'bg-red-600 text-white rounded-md px-4 py-2 text-sm hover:bg-red-700 transition duration-200',
                    icon: 'bg-orange-400 text-black rounded-full'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("Mengirim form dengan ID:", id); // Debug
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>

</body>

</html>
