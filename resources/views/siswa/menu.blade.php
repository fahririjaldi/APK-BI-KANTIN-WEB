
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu | BI-KANTIN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263247;
        }

        header {
            background: #172554;
            color: white;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-actions a {
            color: white;
            text-decoration: none;
            background: #2563eb;
            padding: 12px 18px;
            border-radius: 7px;
        }

        .logout {
            background: #dc2626;
            color: white;
            padding: 12px 18px;
            border: 0;
            border-radius: 7px;
            cursor: pointer;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            color: #172554;
            margin-bottom: 8px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
            margin-top: 25px;
        }

        .menu-card {
            background: white;
            padding: 25px;
            border-radius: 13px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px #00000008;
        }

        .menu-card h3 {
            font-size: 21px;
            margin: 0 0 10px;
            color: #172554;
        }

        .category {
            color: #2563eb;
            font-size: 14px;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            margin: 18px 0;
        }

        .stock {
            margin-bottom: 18px;
            font-size: 14px;
            color: #475569;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            margin: 9px 0 14px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1d4ed8;
        }

        button:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .alert {
            padding: 15px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .error {
            padding: 15px;
            background: #fee2e2;
            color: #991b1b;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .empty {
            background: white;
            padding: 35px;
            border-radius: 12px;
            text-align: center;
            grid-column: 1 / -1;
        }

        @media(max-width: 600px) {
            header {
                padding: 18px;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions a,
            .logout {
                flex: 1;
                text-align: center;
            }

            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="logo">BI-KANTIN</div>

    <div class="header-actions">
        <a href="{{ route('siswa.riwayat') }}">
            Riwayat Pesanan
        </a>

        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">
                Logout
            </button>
        </form>
    </div>
</header>

<div class="container">

    <div class="page-title">
        <h1>Daftar Menu Kantin</h1>
        <p>Pilih makanan atau minuman yang ingin kamu pesan.</p>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="menu-grid">

        @forelse($menus as $menu)

            <div class="menu-card">

                <h3>{{ $menu->nama_menu }}</h3>

                <p class="category">
                    {{ $menu->kategori }}
                </p>

                <div class="price">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </div>

                <div class="stock">
                    Stok tersedia:
                    <strong>{{ $menu->stok }}</strong>
                </div>

                <form action="{{ route('siswa.pesanan.store') }}"
                      method="POST">

                    @csrf

                    <input type="hidden"
                           name="menu_id"
                           value="{{ $menu->id }}">

                    <label>Jumlah pesanan</label>

                    <input type="number"
                           name="jumlah"
                           min="1"
                           max="{{ min(50, $menu->stok) }}"
                           value="1"
                           required
                           {{ $menu->stok < 1 ? 'disabled' : '' }}>

                    <button type="submit"
                            {{ $menu->stok < 1 ? 'disabled' : '' }}>

                        {{ $menu->stok < 1 ? 'Stok Habis' : 'Pesan Sekarang' }}

                    </button>

                </form>

            </div>

        @empty

            <div class="empty">
                <h3>Belum Ada Menu</h3>
                <p>Menu makanan belum ditambahkan oleh admin.</p>
            </div>

        @endforelse

    </div>

</div>

</body>
</html>
