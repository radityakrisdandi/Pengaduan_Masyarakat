<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login — Pengaduan</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Subtle background pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(99,102,241,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 90%, rgba(16,185,129,0.12) 0%, transparent 55%);
            pointer-events: none;
        }

        /* Grid dot pattern */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 1.25rem;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Brand bar */
        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            margin-bottom: 0.75rem;
        }

        .brand-logo svg { width: 26px; height: 26px; fill: white; }

        .brand-name {
            font-size: 1rem;
            font-weight: 600;
            color: rgba(255,255,255,0.85);
            letter-spacing: 0.01em;
        }

        /* Card */
        .card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 20px;
            padding: 2.25rem 2.25rem 2rem;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .card-heading {
            margin-bottom: 1.75rem;
        }

        .card-heading h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.02em;
            line-height: 1.3;
        }

        .card-heading p {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.45);
            margin-top: 0.35rem;
        }

        /* Alert */
        .alert-error {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
        }

        .alert-error ul {
            list-style: none;
            padding: 0;
        }

        .alert-error li {
            font-size: 0.8125rem;
            color: #fca5a5;
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }

        .alert-error li::before {
            content: '!';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: rgba(239,68,68,0.3);
            font-size: 10px;
            font-weight: 700;
            color: #f87171;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-session {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            margin-top: 1rem;
            font-size: 0.8125rem;
            color: #fca5a5;
        }

        /* Form */
        .form-group {
            margin-bottom: 1.125rem;
        }

        label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            margin-bottom: 0.45rem;
            letter-spacing: 0.01em;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 17px;
            height: 17px;
            color: rgba(255,255,255,0.25);
            pointer-events: none;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            height: 46px;
            padding: 0 1rem 0 2.75rem;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 11px;
            font-family: inherit;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.9);
            transition: border-color 0.18s, background 0.18s, box-shadow 0.18s;
            outline: none;
            -webkit-appearance: none;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: rgba(255,255,255,0.2);
        }

        input[type="email"]:hover,
        input[type="password"]:hover {
            border-color: rgba(255,255,255,0.2);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: rgba(99,102,241,0.7);
            background: rgba(99,102,241,0.07);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }

        input.is-invalid {
            border-color: rgba(239,68,68,0.6);
            background: rgba(239,68,68,0.06);
        }

        .toggle-pw {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255,255,255,0.3);
            padding: 4px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s;
        }

        .toggle-pw:hover { color: rgba(255,255,255,0.6); }
        .toggle-pw svg { width: 17px; height: 17px; }

        .field-error {
            font-size: 0.76rem;
            color: #f87171;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Divider */
        .form-divider {
            margin: 1.5rem 0 1.25rem;
            height: 1px;
            background: rgba(255,255,255,0.07);
        }

        /* Buttons */
        .btn-primary {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #6366f1, #7c3aed);
            color: #fff;
            font-family: inherit;
            font-size: 0.9375rem;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: opacity 0.18s, transform 0.12s, box-shadow 0.18s;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 20px rgba(99,102,241,0.35);
        }

        .btn-primary:hover {
            opacity: 0.92;
            box-shadow: 0 4px 24px rgba(99,102,241,0.5);
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        .btn-row {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.875rem;
        }

        .btn-ghost {
            flex: 1;
            height: 42px;
            background: rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.55);
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.09);
            color: rgba(255,255,255,0.8);
            border-color: rgba(255,255,255,0.15);
        }

        /* Footer links */
        .card-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8125rem;
            color: rgba(255,255,255,0.35);
        }

        .card-footer a {
            color: #818cf8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s;
        }

        .card-footer a:hover { color: #a5b4fc; text-decoration: underline; }

        @media (max-width: 480px) {
            .card { padding: 1.75rem 1.5rem 1.5rem; border-radius: 16px; }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">

        <div class="brand">
            <div class="brand-logo">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div class="brand-name">Pengaduan Masyarakat</div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h1>Selamat datang 👋</h1>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert-error" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        >
                    </div>
                    @error('email')
                        <div class="field-error">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        >
                        <button type="button" class="toggle-pw" onclick="togglePassword()" aria-label="Tampilkan/sembunyikan kata sandi">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Session error --}}
                @if (session('error'))
                    <div class="alert-session" role="alert">{{ session('error') }}</div>
                @endif

                <div class="form-divider"></div>

                <button type="submit" class="btn-primary">Masuk</button>

                <div class="btn-row">
                    <button type="reset" class="btn-ghost">Reset Form</button>
                    <button type="button" class="btn-ghost" onclick="window.location.href='/'">
                        ← Kembali
                    </button>
                </div>
            </form>

            <div class="card-footer">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets') }}/vendors/js/vendor.bundle.base.js"></script>
    <script src="{{ asset('assets') }}/js/off-canvas.js"></script>
    <script src="{{ asset('assets') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('assets') }}/js/misc.js"></script>
    <script src="{{ asset('assets') }}/js/settings.js"></script>
    <script src="{{ asset('assets') }}/js/todolist.js"></script>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
                : '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>';
        }
    </script>
</body>

</html>