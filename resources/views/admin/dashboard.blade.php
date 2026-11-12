
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | BI-KANTIN</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263247;
            font-size: 15px;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 260px;
            background: #172554;
            color: white;
            padding: 30px 20px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #cbd5e1;
            font-size: 14px;
            margin-bottom: 40px;
        }

        .nav-title {
            font-size: 12px;
            color: #94a3b8;
            margin: 25px 12px 12px;
            text-transform: uppercase;
        }

        .nav a {
            display: block;
            text-decoration: none;
            color: #dbeafe;
            padding: 15px;
            border-radius: 9px;
            margin: 6px 0;
            font-size: 15px;
        }

        .nav a:hover,
        .nav a.active {
            background: #2563eb;
            color: white;
        }

        /* MAIN */

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            background: white;
            padding: 25px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            gap: 15px;
        }

        .topbar h2 {
            font-size: 25px;
        }

        .admin-tag {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 14px;
        }

        .content {
            padding: 35px;
        }

        .welcome {
            margin-bottom: 28px;
        }

        .welcome h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #64748b;
            font-size: 16px;
        }

        /* STATISTIK */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-bottom: 30px;
        }

        .stat {
            background: white;
            border-radius: 14px;
            padding: 28px;
            border: 1px solid #e8edf4;
            box-shadow: 0 3px 12px #0f172a08;
        }

        .stat-label {
            color: #64748b;
            font-size: 16px;
        }

        .stat-number {
            font-size: 38px;
            font-weight: bold;
            margin: 18px 0 8px;
            color: #172554;
        }

        .stat-note {
            color: #64748b;
            font-size: 14px;
        }

        /* PANEL */

        .panel {
            background: white;
            border-radius: 14px;
            padding: 28px;
            border: 1px solid #e8edf4;
            box-shadow: 0 3px 12px #0f172a08;
            margin-bottom: 25px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .section-heading h2 {
            font-size: 23px;
            color: #172554;
        }

        /* FORM */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px;
            border: 1px solid #dbe1ea;
            border-radius: 8px;
            outline: none;
            font-size: 15px;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
        }

        /* BUTTON */

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 8px;
            padding: 14px 19px;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-green {
            background: #16a34a;
        }

        .btn-green:hover {
            background: #15803d;
        }

        .btn-red {
            background: #dc2626;
        }

        .btn-red:hover {
            background: #b91c1c;
        }

        /* TABLE */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th, td {
            padding: 17px 14px;
            text-align: left;
            border-bottom: 1px solid #eef2f7;
            font-size: 15px;
            vertical-align: middle;
        }

        th {
            color: #475569;
            font-weight: bold;
            background: #f8fafc;
            white-space: nowrap;
        }

        td {
            line-height: 1.5;
        }

        .pill {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
        }

        .pill-empty {
            background: #fee2e2;
            color: #991b1b;
        }

        /* EDIT */

        .edit-form {
            min-width: 190px;
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .edit-form input {
            width: 100%;
            padding: 11px;
            border: 1px solid #dbe1ea;
            border-radius: 7px;
            font-size: 14px;
        }

        .edit-form button,
        .delete-form button {
            width: 100%;
        }

        /* ALERT */

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 30px;
        }

        .footer {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 25px;
        }

        /* RESPONSIVE */

        @media(max-width: 1100px) {
            .sidebar {
                width: 220px;
            }

            .content {
                padding: 25px;
            }
        }

        @media(max-width: 850px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 22px;
            }

            .subtitle {
                margin-bottom: 15px;
            }

            .nav {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .nav-title {
                margin-top: 15px;
            }

            .nav a {
                padding: 12px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 20px;
            }
        }

        @media(max-width: 500px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .topbar h2 {
                font-size: 19px;
            }

            .panel {
                padding: 18px;
            }

            .section-heading h2 {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>

@php
    $menus = \App\Models\Menu::orderBy('kategori')
        ->orderBy('nama_menu')
        ->get();

    $totalMenu = \App\Models\Menu::count();
    $totalPesanan = \App\Models\Pesanan::count();
    $totalPengguna = \App\Models\User::count();
@endphp

<div class="layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="brand">BI-KANTIN</div>
        <div class="subtitle">Sistem Informasi Kantin Sekolah</div>

        <div class="nav-title">Menu Utama</div>

        <nav class="nav">

            <a href="{{ url('/admin/dashboard') }}" class="active">
                Dashboard
            </a>

            <a href="#tambah-menu">
                Tambah Menu
            </a>

            <a href="#daftar-menu">
                Daftar Menu
            </a>

            <a href="{{ route('admin.pesanan.index') }}">
                Pesanan
            </a>

        </nav>

        <div class="nav-title">Akun</div>

        <nav class="nav">
            <a href="{{ url('/login') }}">
                Halaman Login
            </a>
        </nav>

        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-red"
                    style="width:100%; margin-top:15px;">
                Logout
            </button>
        </form>

    </aside>

    <!-- KONTEN UTAMA -->

    <main class="main">

        <header class="topbar">
            <h2>Dashboard Admin</h2>
            <div class="admin-tag">Administrator</div>
        </header>

        <section class="content">

            <div class="welcome">
                <h1>Selamat Datang, Admin!</h1>
                <p>
                    Kelola makanan, minuman, stok, dan pesanan
                    kantin sekolah melalui BI-KANTIN.
                </p>
            </div>

            <!-- PESAN BERHASIL / ERROR -->

            @if(session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- STATISTIK -->

            <div class="stats">

                <div class="stat">
                    <div class="stat-label">Total Menu</div>
                    <div class="stat-number">{{ $totalMenu }}</div>
                    <div class="stat-note">Menu terdaftar</div>
                </div>

                <div class="stat">
                    <div class="stat-label">Total Pesanan</div>
                    <div class="stat-number">{{ $totalPesanan }}</div>
                    <div class="stat-note">Pesanan tercatat</div>
                </div>

                <div class="stat">
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-number">{{ $totalPengguna }}</div>
                    <div class="stat-note">Admin dan siswa</div>
                </div>

            </div>

            <!-- FORM TAMBAH MENU -->

            <div class="panel" id="tambah-menu">

                <div class="section-heading">
                    <h2>Tambah Makanan / Minuman</h2>
                </div>

                <form action="{{ route('admin.menu.store') }}"
                      method="POST">

                    @csrf

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Nama Makanan / Minuman</label>
                            <input type="text"
                                   name="nama_menu"
                                   placeholder="Contoh: Nasi Goreng"
                                   value="{{ old('nama_menu') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number"
                                   name="harga"
                                   placeholder="15000"
                                   min="0"
                                   value="{{ old('harga') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Stok</label>
                            <input type="number"
                                   name="stok"
                                   placeholder="20"
                                   min="0"
                                   value="{{ old('stok', 10) }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" required>
                                <option value="">Pilih kategori</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn">
                        + Tambahkan Menu
                    </button>

                </form>

            </div>

            <!-- DAFTAR MENU -->

            <div class="panel" id="daftar-menu">

                <div class="section-heading">
                    <h2>Daftar Menu Kantin</h2>

                    <span class="admin-tag">
                        {{ $totalMenu }} Menu
                    </span>
                </div>

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Edit Menu</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($menus as $menu)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $menu->nama_menu }}</strong>
                                </td>

                                <td>{{ $menu->kategori }}</td>

                                <td>
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </td>

                                <td>{{ $menu->stok }}</td>

                                <td>
                                    @if($menu->stok > 0)
                                        <span class="pill">Tersedia</span>
                                    @else
                                        <span class="pill pill-empty">Habis</span>
                                    @endif
                                </td>

                                <!-- FORM EDIT -->

                                <td>

                                    <form
                                        action="{{ route('admin.menu.update', $menu->id) }}"
                                        method="POST"
                                        class="edit-form">

                                        @csrf
                                        @method('PUT')

                                        <input type="text"
                                               name="nama_menu"
                                               value="{{ $menu->nama_menu }}"
                                               placeholder="Nama menu"
                                               required>

                                        <input type="number"
                                               name="harga"
                                               value="{{ $menu->harga }}"
                                               min="0"
                                               placeholder="Harga"
                                               required>

                                        <input type="number"
                                               name="stok"
                                               value="{{ $menu->stok }}"
                                               min="0"
                                               placeholder="Stok"
                                               required>

                                        <input type="text"
                                               name="kategori"
                                               value="{{ $menu->kategori }}"
                                               placeholder="Kategori"
                                               required>

                                        <button type="submit"
                                                class="btn btn-green">
                                            Simpan Perubahan
                                        </button>

                                    </form>

                                </td>

                                <!-- FORM HAPUS -->

                                <td>

                                    <form
                                        action="{{ route('admin.menu.destroy', $menu->id) }}"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="return confirm('Yakin ingin menghapus menu ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-red">
                                            Hapus Menu
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="empty">
                                    Belum ada menu yang terdaftar.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="footer">
                © {{ date('Y') }} BI-KANTIN
                · Sistem Informasi Kantin Sekolah
            </div>

        </section>

    </main>

</div>

</body>
</html>
