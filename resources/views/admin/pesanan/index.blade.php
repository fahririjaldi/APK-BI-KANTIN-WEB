<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan | BI-KANTIN</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 30px;
            color: #263247;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1 {
            color: #172554;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #172554;
            color: white;
        }

        .status {
            background: #fef3c7;
            color: #92400e;
            padding: 6px 10px;
            border-radius: 6px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="/admin/dashboard">Kembali ke Dashboard</a>

    <h1>Daftar Pesanan Siswa</h1>
    <p>Data pesanan yang masuk ke BI-KANTIN.</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pesanans as $pesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->user->username ?? 'Tidak diketahui' }}</td>
                    <td>{{ $pesanan->menu->nama_menu ?? 'Menu dihapus' }}</td>
                    <td>{{ $pesanan->jumlah }}</td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="status">
                            {{ $pesanan->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">
                        Belum ada pesanan masuk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>