
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan | BI-KANTIN</title>

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
        }

        .sidebar {
            width: 245px;
            height: 100vh;
            background: #172554;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 30px 20px;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 45px;
        }

        .sidebar a {
            display: block;
            color: #dbeafe;
            text-decoration: none;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #2563eb;
            color: white;
        }

        .main {
            margin-left: 245px;
            padding: 35px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
        }

        .header h1 {
            color: #172554;
            font-size: 28px;
        }

        .subtitle {
            color: #64748b;
            margin-top: 8px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #00000008;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #eff6ff;
            color: #172554;
            text-align: left;
            padding: 16px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .diproses {
            background: #dbeafe;
            color: #1e40af;
        }

        .selesai {
            background: #dcfce7;
            color: #166534;
        }

        .dibatalkan {
            background: #fee2e2;
            color: #991b1b;
        }

        .kosong {
            text-align: center;
            padding: 45px;
            color: #64748b;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
        }

        @media(max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .logo {
                margin-bottom: 15px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="logo">BI-KANTIN</div>

    <a href="{{ route('siswa.menu') }}">Daftar Menu</a>
    <a href="{{ route('siswa.riwayat') }}" class="active">Riwayat Pesanan</a>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit" style="
            width:100%;
            padding:15px;
            background:#dc2626;
            border:0;
            border-radius:8px;
            color:white;
            cursor:pointer;
            margin-top:15px;">
            Keluar
        </button>
    </form>
</div>

<div class="main">

    <div class="header">
        <div>
            <h1>Riwayat Pesanan</h1>
            <p class="subtitle">
                Lihat semua pesanan makanan yang pernah kamu buat.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:15px;margin-bottom:20px;border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Makanan</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pesanans as $pesanan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $pesanan->menu->nama_menu ?? 'Menu tidak tersedia' }}
                            </td>

                            <td>{{ $pesanan->jumlah }}</td>

                            <td>
                                Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </td>

                            <td>
                                @php
                                    $statusClass = match($pesanan->status) {
                                        'Menunggu' => 'menunggu',
                                        'Diproses' => 'diproses',
                                        'Selesai' => 'selesai',
                                        'Dibatalkan' => 'dibatalkan',
                                        default => 'menunggu',
                                    };
                                @endphp

                                <span class="status {{ $statusClass }}">
                                    {{ $pesanan->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="kosong">
                                Belum ada riwayat pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('siswa.menu') }}" class="btn">
            Kembali ke Daftar Menu
        </a>
    </div>

</div>

</body>
</html>
