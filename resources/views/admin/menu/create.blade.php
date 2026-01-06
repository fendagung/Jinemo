<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Cafe Jinemo - Admin</a>
        <a href="{{ route('menu.index') }}" class="btn btn-outline-light btn-sm">
            Kembali
        </a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Tambah Menu</h3>

    <!-- PERUBAHAN PENTING ADA DI SINI -->
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <!-- TAMBAHAN INPUT GAMBAR -->
        <div class="mb-3">
            <label class="form-label">Gambar Menu</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>

</body>
</html>
