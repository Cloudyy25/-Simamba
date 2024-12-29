<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kegiatan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-bold text-orange-500 mb-4">Edit Kegiatan</h2>
    <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama_kegiatan" class="block text-sm font-medium">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="tim_kerja" class="block text-sm font-medium">Tim Kerja</label>
            <input type="text" name="tim_kerja" id="tim_kerja" value="{{ $kegiatan->tim_kerja }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="mulai" class="block text-sm font-medium">Mulai</label>
            <input type="date" name="mulai" id="mulai" value="{{ $kegiatan->mulai }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="berakhir" class="block text-sm font-medium">Berakhir</label>
            <input type="date" name="berakhir" id="berakhir" value="{{ $kegiatan->berakhir }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="target" class="block text-sm font-medium">Target</label>
            <input type="number" name="target" id="target" value="{{ $kegiatan->target }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="realisasi" class="block text-sm font-medium">Realisasi</label>
            <input type="number" name="realisasi" id="realisasi" value="{{ $kegiatan->realisasi }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="satuan" class="block text-sm font-medium">Satuan</label>
            <input type="text" name="satuan" id="satuan" value="{{ $kegiatan->satuan }}" class="border p-2 w-full" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Kegiatan</button>
    </form>
  </div>
</body>
</html>
