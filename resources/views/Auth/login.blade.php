<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login — Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background-color: #0b1121;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }

        /* Animated Glowing Orbs Background */
        body::before, body::after {
            content: '';
            position: fixed;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: 0;
            animation: float 12s infinite ease-in-out alternate;
            pointer-events: none;
        }

        body::before {
            background: rgba(99, 102, 241, 0.15);
            top: -20%;
            left: -10%;
        }

        body::after {
            background: rgba(139, 92, 246, 0.15);
            bottom: -20%;
            right: -10%;
            animation-delay: -6s;
        }

        /* Subtle Grid Texture */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 32px 32px;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 50px) scale(1.1); }
        }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 1.5rem;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Brand section with floating effect */
        .brand {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            margin-bottom: 1rem;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3), inset 0 2px 0 rgba(255,255,255,0.2);
            animation: levitate 4s infinite ease-in-out;
        }

        @keyframes levitate {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .brand-logo svg { width: 28px; height: 28px; fill: white; }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        /* Premium Glass Card */
        .card {
            background: rgba(17, 24, 39, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            padding: 2.5rem;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .card-heading { margin-bottom: 2rem; text-align: center; }

        .card-heading h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .card-heading p {
            font-size: 0.9rem;
            color: #94a3b8;
        }

        /* Alerts */
        .alert-error, .alert-session {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-left: 4px solid #ef4444;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-error ul { list-style: none; padding: 0; }
        .alert-error li, .alert-session {
            font-size: 0.85rem;
            color: #fca5a5;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Inputs (Fixed for both Autofill and Toggle Type Issues) */
        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #64748b;
            transition: color 0.3s ease;
            pointer-events: none;
            z-index: 2;
        }

        /* Target all types inside input-wrap globally */
        .input-wrap input {
            width: 100%;
            height: 52px;
            padding: 0 1rem 0 3rem;
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            font-family: inherit;
            font-size: 0.95rem;
            color: #ffffff !important;
            transition: all 0.3s ease;
            outline: none;
            position: relative;
            z-index: 1;
        }

        .input-wrap input::placeholder { color: #475569; }

        .input-wrap input:hover {
            border-color: rgba(255, 255, 255, 0.15);
            background: rgba(15, 23, 42, 0.8) !important;
        }

        .input-wrap input:focus {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.05) !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .input-wrap input:focus ~ .input-icon { color: #6366f1; }

        .input-wrap input.is-invalid {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.05) !important;
        }

        /* FORCE OVERRIDE BROWSER AUTOFILL DESIGN (Glitches fixed here) */
        .input-wrap input:-webkit-autofill,
        .input-wrap input:-webkit-autofill:hover,
        .input-wrap input:-webkit-autofill:focus,
        .input-wrap input:-webkit-autofill:active {
            -webkit-text-fill-color: #ffffff !important;
            box-shadow: 0 0 0px 1000px #0e1626 inset !important; /* Forces dark inner shield background */
            border-color: rgba(99, 102, 241, 0.4);
            transition: background-color 5000s ease-in-out 0s;
        }

        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            z-index: 2;
        }

        .toggle-pw:hover {
            color: #e2e8f0;
            background: rgba(255,255,255,0.05);
        }

        .field-error {
            font-size: 0.8rem;
            color: #f87171;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            margin: 1.75rem 0 1.5rem;
        }

        /* Buttons Enhancement */
        .btn-primary {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.6);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: skewX(-25deg);
            transition: all 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -6px rgba(99, 102, 241, 0.8);
        }

        .btn-primary:hover::after { left: 150%; }

        .btn-primary:active { transform: translateY(0); }

        .btn-row {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-ghost {
            flex: 1;
            height: 46px;
            background: transparent;
            color: #94a3b8;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.05);
            color: #ffffff;
            border-color: rgba(255,255,255,0.2);
        }

        .card-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #94a3b8;
        }

        .card-footer a {
            color: #818cf8;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .card-footer a:hover { color: #c7d2fe; }

        @media (max-width: 480px) {
            .card { padding: 2rem 1.5rem; border-radius: 20px; }
            .login-wrapper { padding: 1rem; }
        }
    </style>
</head>

<body>
    <div class="bg-grid"></div>
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
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $error }}
                            </li>
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
                            <svg id="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <div class="alert-session" role="alert">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ session('error') }}
                    </div>
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