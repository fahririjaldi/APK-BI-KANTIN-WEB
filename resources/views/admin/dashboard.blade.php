
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | BI-KANTIN</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263247;
        }
        .layout { display: flex; min-height: 100vh; }
        .sidebar {
            width: 245px; background: #172554; color: white;
            padding: 28px 18px; flex-shrink: 0;
        }
        .brand { font-size: 23px; font-weight: bold; margin-bottom: 8px; }
        .subtitle { color: #cbd5e1; font-size: 12px; margin-bottom: 36px; }
        .nav-title {
            font-size: 11px; color: #94a3b8;
            margin: 20px 12px 10px; text-transform: uppercase;
        }
        .nav a {
            display: block; text-decoration: none; color: #dbeafe;
            padding: 13px 14px; border-radius: 9px; margin: 5px 0;
        }
        .nav a.active, .nav a:hover { background: #2563eb; color: white; }
        .main { flex: 1; min-width: 0; }
        .topbar {
            background: white; padding: 22px 30px;
            display: flex; justify-content: space-between;
            align-items: center; border-bottom: 1px solid #e5e7eb;
            gap: 15px;
        }
        .topbar h2 { font-size: 21px; }
        .admin-tag {
            background: #dbeafe; color: #1d4ed8;
            padding: 9px 13px; border-radius: 20px; font-size: 13px;
        }
        .content { padding: 30px; }
        .welcome { margin-bottom: 25px; }
        .welcome h1 { font-size: 26px; margin-bottom: 9px; }
        .welcome p { color: #64748b; font-size: 14px; }
        .stats {
            display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px; margin-bottom: 28px;
        }
        .stat, .panel {
            background: white; border-radius: 14px; padding: 22px;
            border: 1px solid #e8edf4;
            box-shadow: 0 3px 12px #0f172a08;
        }
        .stat-label { color: #64748b; font-size: 13px; }
        .stat-number { font-size: 30px; font-weight: bold; margin: 15px 0 7px; }
        .stat-note { color: #64748b; font-size: 12px; }
        .section-heading {
            display: flex; justify-content: space-between;
            align-items: center; gap: 12px; margin-bottom: 18px;
        }
        .section-heading h2 { font-size: 18px; }
        .btn {
            display: inline-block; background: #2563eb; color: white;
            border: 0; border-radius: 8px; padding: 11px 15px;
            text-decoration: none; font-size: 13px; cursor: pointer;
        }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 450px; }
        th, td {
            padding: 15px 12px; text-align: left;
            border-bottom: 1px solid #eef2f7; font-size: 13px;
        }
        th { color: #64748b; font-weight: 600; background: #f8fafc; }
        .pill {
            display: inline-block; padding: 6px 10px; border-radius: 20px;
            background: #dcfce7; color: #166534; font-size: 12px;
        }
        .empty { text-align: center; color: #64748b; padding: 28px; }
        .footer { color: #94a3b8; font-size: 12px; margin-top: 24px; }
        @media (max-width: 850px) {
            .sidebar { width: 190px; }
            .stats { grid-template-columns: 1fr; }
            .content { padding: 20px; }
        }
        @media (max-width: 560px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 18px; }
            .subtitle { margin-bottom: 15px; }
            .nav { display: flex; flex-wrap: wrap; gap: 5px; }
            .nav-title { margin-top: 12px; }
            .nav a { padding: 10px; }
            .topbar { padding: 18px; }
            .topbar h2 { font-size: 17px; }
            .content { padding: 16px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand"> BI-KANTIN</div>
        <div class="subtitle">Sistem Informasi Kantin Sekolah</div>

        <div class="nav-title">Menu Utama</div>
        <nav class="nav">
            <a href="/admin/dashboard" class="active"> Dashboard</a>
            <a href="#daftar-menu">☰ Daftar Menu</a>
            <a href="#pesanan"> Pesanan</a>
        </nav>

        <div class="nav-title">Akun</div>
        <nav class="nav">
            <a href="/login">↪ Halaman Login</a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h2>Dashboard Admin</h2>
            <div class="admin-tag">● Administrator</div>
        </header>

        <section class="content">
            <div class="welcome">
                <h1>Selamat Datang, Admin! </h1>
                <p>Kelola menu dan pantau aktivitas kantin sekolah dari satu tempat.</p>
            </div>

            <div class="stats">
                <div class="stat">
                    <div class="stat-label"> Total Menu</div>
                    <div class="stat-number">{{ \Illuminate\Support\Facades\DB::table('menu')->count() }}</div>
                    <div class="stat-note">Menu yang terdaftar</div>
                </div>
                <div class="stat">
                    <div class="stat-label"> Total Pesanan</div>
                    <div class="stat-number">{{ \Illuminate\Support\Facades\DB::table('pesanan')->count() }}</div>
                    <div class="stat-note">Pesanan tercatat</div>
                </div>
                <div class="stat">
                    <div class="stat-label"> Total Pengguna</div>
                    <div class="stat-number">{{ \Illuminate\Support\Facades\DB::table('users')->count() }}</div>
                    <div class="stat-note">Admin dan siswa</div>
                </div>
            </div>

            <div class="panel" id="daftar-menu">
                <div class="section-heading">
                    <h2>Daftar Menu Kantin</h2>
                    <a href="#daftar-menu" class="btn">Daftar Menu</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse (\Illuminate\Support\Facades\DB::table('menu')->get() as $index => $menu)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ $menu->kategori }}</td>
                                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td><span class="pill">Tersedia</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">Belum ada menu yang terdaftar.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="footer">© {{ date('Y') }} BI-KANTIN · Sistem Informasi Kantin Sekolah</div>
        </section>
    </main>
</div>
</body>
</html>
