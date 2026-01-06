<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Menu | Cafe Jinemo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Cafe Jinemo - Admin</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('menu.index') }}">Menu</a>
            </li>
        </ul>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Data Menu</h3>
        <a href="{{ route('menu.create') }}" class="btn btn-primary">
            + Tambah Menu
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th> <!-- KOLOM BARU -->
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($menus as $menu)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <!-- TAMPIL GAMBAR -->
                <td>
                    @if($menu->gambar)
                        <img src="{{ asset('storage/'.$menu->gambar) }}" 
                             alt="{{ $menu->nama_menu }}"
                             width="80" class="rounded">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                <td>{{ $menu->nama_menu }}</td>
                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus menu ini?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada menu</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
