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
  <div class="grid grid-cols-[250px_1fr] h-screen">
    <!-- Sidebar -->
    <aside class="bg-white text-orange-500 flex flex-col items-center py-12 px-5 h-full">
      <img src="{{ asset('images/bps.png') }}" alt="BPS Sumbawa" class="w-24 mb-10">
      <h2 class="text-center text-xl text-black">Badan Pusat Statistik <br> Kabupaten Sumbawa</h2>
      <nav class="w-full">
        <ul class="text-center">
          <li class="py-4 cursor-pointer">Dashboard</li>
          <li class="py-4 cursor-pointer bg-orange-600 text-white">Daftar Kegiatan</li>
          <li class="py-4 cursor-pointer">Jadwal Kegiatan</li>
          <li class="py-4 cursor-pointer">Evaluasi Kegiatan</li>
        </ul>
      </nav>
      <button class="mt-auto py-2 px-14 bg-red-600 text-white rounded-lg">Log Out</button>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-col overflow-y-auto">
      <header class="flex justify-between items-center bg-gradient-to-r from-yellow-400 to-orange-400 px-5 py-2 h-16 text-white">
        <h1>Tambah Kegiatan</h1>
      </header>

      <main class="px-6 py-4">
        <h2 class="text-2xl font-bold text-orange-500 mb-6">Form Tambah Kegiatan</h2>

        <form action="{{ route('kegiatan.store') }}" method="POST">
            @csrf <!-- CSRF token untuk keamanan -->
            <div class="mb-4">
                <label for="nama_kegiatan" class="block text-sm font-medium">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="border p-2 w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="tim_kerja" class="block text-sm font-medium">Tim Kerja</label>
                <input type="text" name="tim_kerja" id="tim_kerja" class="border p-2 w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="mulai" class="block text-sm font-medium">Mulai</label>
                <input type="date" name="mulai" id="mulai" class="border p-2 w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="berakhir" class="block text-sm font-medium">Berakhir</label>
                <input type="date" name="berakhir" id="berakhir" class="border p-2 w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="target" class="block text-sm font-medium">Target</label>
                <input type="number" name="target" id="target" class="border p-2 w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="realisasi" class="block text-sm font-medium">Realisasi</label>
                <input type="number" name="realisasi" id="realisasi" class="border p-2 w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="satuan" class="block text-sm font-medium">Satuan</label>
                <input type="text" name="satuan" id="satuan" class="border p-2 w-full" required>
            </div>
        
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan Kegiatan</button>
        </form>
        
      </main>
    </div>
  </div>
</body>
</html>
