
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan | BI-KANTIN</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263247;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 { color: #172554; }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000008;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #172554;
            color: white;
        }

        select {
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            margin-bottom: 7px;
        }

        button {
            padding: 10px 14px;
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover { background: #1d4ed8; }

        .alert {
            padding: 13px;
            margin-bottom: 15px;
            border-radius: 7px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        @media(max-width: 600px) {
            body { padding: 15px; }
        }
    </style>
</head>

<body>
<div class="container">

    <a href="{{ url('/admin/dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

    <h1>Kelola Pesanan</h1>
    <p>Admin dapat melihat dan mengubah status pesanan siswa.</p>

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

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Makanan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Ubah Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pesanans as $pesanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $pesanan->user->username ?? 'Pengguna tidak tersedia' }}
                        </td>

                        <td>
                            {{ $pesanan->menu->nama_menu ?? 'Menu tidak tersedia' }}
                        </td>

                        <td>{{ $pesanan->jumlah }}</td>

                        <td>
                            Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </td>

                        <td>
                            <strong>{{ $pesanan->status }}</strong>
                        </td>

                        <td>
                            @if($pesanan->status !== 'Dibatalkan' && $pesanan->status !== 'Selesai')
                                <form action="{{ route('admin.pesanan.status', $pesanan->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')

                                    <select name="status" required>
                                        <option value="Menunggu"
                                            {{ $pesanan->status == 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu
                                        </option>

                                        <option value="Diproses"
                                            {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>

                                        <option value="Selesai"
                                            {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>

                                        <option value="Dibatalkan">
                                            Dibatalkan
                                        </option>
                                    </select>

                                    <button type="submit">
                                        Simpan
                                    </button>
                                </form>
                            @else
                                <span>Status sudah final</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:30px;">
                            Belum ada pesanan siswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
