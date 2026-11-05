<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BI-KANTIN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f5e9, #f4f7f5);
            color: #243329;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.10);
        }

        .logo {
            text-align: center;
            font-size: 42px;
            margin-bottom: 10px;
        }

        h1 {
            margin: 0;
            text-align: center;
            color: #247442;
            font-size: 28px;
        }

        .subtitle {
            margin: 10px 0 28px;
            text-align: center;
            color: #68756b;
            font-size: 14px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccd7ce;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #27834a;
            box-shadow: 0 0 0 3px rgba(39, 131, 74, 0.12);
        }

        .login-button {
            width: 100%;
            margin-top: 8px;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: #27834a;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-button:hover {
            background: #1e693a;
        }

        .alert-error {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            background: #fff0f0;
            color: #a12626;
            font-size: 14px;
        }

        .alert-success {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            background: #eaf8ee;
            color: #216638;
            font-size: 14px;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            color: #7a857c;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 26px 22px;
            }
        }
    </style>
</head>

<body>
    <main class="login-container">
        <div class="logo">🍽️</div>

        <h1>BI-KANTIN</h1>

        <p class="subtitle">
            Selamat datang!<br>
            Silakan login untuk melanjutkan.
        </p>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Login
            </button>
        </form>

        <div class="footer">
            &copy; {{ date('Y') }} BI-KANTIN
        </div>
    </main>
</body>
</html>