
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu | BI-KANTIN</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263247;
        }

        .container {
            max-width: 1150px;
            margin: auto;
        }

        .panel {
            background: white;
            padding: 22px;
            border-radius: 12px;
            margin-bottom: 22px;
            border: 1px solid #e5e7eb;
        }

        h1, h2 { color: #172554; }

        input, select {
            width: 100%;
            padding: 11px;
            margin: 7px 0 14px;
            border: 1px solid #ddd;
            border-radius: 7px;
        }

        button, .btn {
            display: inline-block;
            padding: 10px 14px;
            border: 0;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .delete { background: #dc2626; }
        .success { background: #dcfce7; color: #166534; padding: 12px; }
        .error { background: #fee2e2; color: #991b1b; padding: 12px; }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th { background: #172554; color: white; }

        .edit-form {
            min-width: 180px;
        }

        .edit-form input {
            margin: 4px 0;
        }
    </style>
</head>

<body>
<div class="container">

    <a href="{{ url('/admin/dashboard') }}" class="btn">
        Kembali ke Dashboard
    </a>

    <h1>Pengelolaan Menu Kantin</h1>
    <p>Tambah, edit, dan atur stok makanan atau minuman.</p>

    @if(session('success'))
        <div class="panel success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="panel error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="panel error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel">
        <h2>Tambah Menu Baru</h2>

        <form action="{{ route('admin.menu.store') }}" method="POST">
            @csrf

            <label>Nama Makanan / Minuman</label>
            <input type="text" name="nama_menu"
                   value="{{ old('nama_menu') }}" required>

            <label>Harga</label>
            <input type="number" name="harga"
                   min="0" value="{{ old('harga') }}" required>

            <label>Stok</label>
            <input type="number" name="stok"
                   min="0" value="{{ old('stok', 10) }}" required>

            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">Pilih kategori</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Snack">Snack</option>
            </select>

            <button type="submit">Tambah Menu</button>
        </form>
    </div>

    <div class="panel">
        <h2>Daftar Menu</h2>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($menus as $menu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </td>
                            <td>{{ $menu->stok }}</td>
                            <td>{{ $menu->kategori }}</td>

                            <td>
                                <form class="edit-form"
                                      action="{{ route('admin.menu.update', $menu->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="nama_menu"
                                           value="{{ $menu->nama_menu }}" required>

                                    <input type="number" name="harga"
                                           value="{{ $menu->harga }}"
                                           min="0" required>

                                    <input type="number" name="stok"
                                           value="{{ $menu->stok }}"
                                           min="0" required>

                                    <input type="text" name="kategori"
                                           value="{{ $menu->kategori }}" required>

                                    <button type="submit">Simpan Edit</button>
                                </form>
                            </td>

                            <td>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Belum ada menu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
