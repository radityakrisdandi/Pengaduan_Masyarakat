<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar — Sistem Informasi Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: #0c1322;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 2rem 1.25rem;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 70% 55% at 10% 5%, rgba(20,184,166,0.16) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 95%, rgba(59,130,246,0.12) 0%, transparent 55%);
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Brand */
        .brand {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #0d9488, #0891b2);
            margin-bottom: 0.85rem;
            box-shadow: 0 6px 24px rgba(13,148,136,0.35);
        }

        .brand-logo svg { width: 28px; height: 28px; stroke: white; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }

        .brand-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.45);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .brand-title {
            font-size: 1rem;
            font-weight: 600;
            color: rgba(255,255,255,0.82);
            margin-top: 0.2rem;
            letter-spacing: -0.01em;
        }

        /* Card */
        .card {
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 22px;
            padding: 2.25rem 2.25rem 2rem;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .card-heading {
            margin-bottom: 1.75rem;
        }

        .card-heading h1 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.02em;
            line-height: 1.3;
        }

        .card-heading p {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.4);
            margin-top: 0.35rem;
        }

        /* Steps indicator */
        .steps {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 1.75rem;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .step-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.3);
            transition: all 0.2s;
        }

        .step.active .step-num {
            background: linear-gradient(135deg, #0d9488, #0891b2);
            border-color: transparent;
            color: white;
            box-shadow: 0 2px 10px rgba(13,148,136,0.4);
        }

        .step.done .step-num {
            background: rgba(13,148,136,0.2);
            border-color: rgba(13,148,136,0.4);
            color: #2dd4bf;
        }

        .step-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.3);
            font-weight: 500;
        }

        .step.active .step-label { color: rgba(255,255,255,0.7); }
        .step.done .step-label { color: #2dd4bf; }

        .step-line {
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 0 10px;
        }

        /* Alert */
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
        }

        .alert-error ul { list-style: none; padding: 0; }

        .alert-error li {
            font-size: 0.8rem;
            color: #fca5a5;
            display: flex;
            align-items: flex-start;
            gap: 6px;
            padding: 2px 0;
        }

        .alert-error li::before {
            content: '!';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: rgba(239,68,68,0.25);
            font-size: 9px;
            font-weight: 700;
            color: #f87171;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* Form groups */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.875rem;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            stroke: rgba(255,255,255,0.22);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            height: 44px;
            padding: 0 1rem 0 2.6rem;
            background: rgba(255,255,255,0.055);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 11px;
            font-family: inherit;
            font-size: 0.875rem;
            color: rgba(255,255,255,0.88);
            transition: border-color 0.18s, background 0.18s, box-shadow 0.18s;
            outline: none;
            -webkit-appearance: none;
        }

        input::placeholder { color: rgba(255,255,255,0.18); }

        input:hover { border-color: rgba(255,255,255,0.16); }

        input:focus {
            border-color: rgba(13,148,136,0.65);
            background: rgba(13,148,136,0.07);
            box-shadow: 0 0 0 3px rgba(13,148,136,0.14);
        }

        input.is-invalid {
            border-color: rgba(239,68,68,0.55);
            background: rgba(239,68,68,0.05);
        }

        .toggle-pw {
            position: absolute;
            right: 11px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255,255,255,0.25);
            padding: 4px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: color 0.15s;
        }

        .toggle-pw:hover { color: rgba(255,255,255,0.55); }
        .toggle-pw svg { width: 16px; height: 16px; }

        .field-error {
            font-size: 0.75rem;
            color: #f87171;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Password strength */
        .pw-strength {
            margin-top: 0.5rem;
        }

        .pw-strength-bar {
            display: flex;
            gap: 4px;
            margin-bottom: 0.3rem;
        }

        .pw-strength-bar span {
            flex: 1;
            height: 3px;
            border-radius: 99px;
            background: rgba(255,255,255,0.08);
            transition: background 0.3s;
        }

        .pw-strength-label {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.3);
            transition: color 0.3s;
        }

        /* Checkbox */
        .check-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 0.25rem 0 1.25rem;
        }

        .check-group input[type="checkbox"] {
            width: 17px;
            height: 17px;
            min-width: 17px;
            padding: 0;
            margin-top: 2px;
            border-radius: 5px;
            accent-color: #0d9488;
            cursor: pointer;
        }

        .check-group label {
            font-size: 0.8125rem;
            color: rgba(255,255,255,0.45);
            margin: 0;
            cursor: pointer;
            line-height: 1.5;
        }

        .check-group label a {
            color: #2dd4bf;
            text-decoration: none;
            font-weight: 500;
        }

        .check-group label a:hover { text-decoration: underline; }

        .form-divider {
            height: 1px;
            background: rgba(255,255,255,0.06);
            margin: 1.5rem 0 1.25rem;
        }

        /* Submit */
        .btn-primary {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #0d9488, #0891b2);
            color: #fff;
            font-family: inherit;
            font-size: 0.9375rem;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: opacity 0.18s, transform 0.12s, box-shadow 0.18s;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 20px rgba(13,148,136,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            opacity: 0.91;
            box-shadow: 0 4px 28px rgba(13,148,136,0.45);
        }

        .btn-primary:active { transform: scale(0.98); }

        .btn-ghost {
            width: 100%;
            height: 42px;
            background: rgba(255,255,255,0.04);
            color: rgba(255,255,255,0.45);
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            cursor: pointer;
            margin-top: 0.75rem;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.7);
            border-color: rgba(255,255,255,0.14);
        }

        /* Footer */
        .card-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8125rem;
            color: rgba(255,255,255,0.32);
        }

        .card-footer a {
            color: #2dd4bf;
            text-decoration: none;
            font-weight: 500;
        }

        .card-footer a:hover { color: #5eead4; text-decoration: underline; }

        @media (max-width: 520px) {
            .card { padding: 1.75rem 1.5rem 1.5rem; border-radius: 16px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>

<body>
    <div class="register-wrapper">

        <div class="brand">
            <div class="brand-logo">
                <svg viewBox="0 0 24 24">
                    <path d="M8 9h8M8 13h5M9 19H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5"/>
                    <circle cx="17" cy="17" r="3"/><path d="m21 21-1.5-1.5"/>
                </svg>
            </div>
            <div class="brand-name">Sistem Informasi</div>
            <div class="brand-title">Pengaduan Masyarakat</div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h1>Buat akun baru ✍️</h1>
                <p>Daftarkan diri Anda untuk mengakses layanan pengaduan</p>
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

            <form action="{{ route('registerProses') }}" method="POST">
                @csrf

                {{-- Username --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/></svg>
                        <input type="text" id="username" name="name" placeholder="budi_santoso" value="{{ old('name') }}" autocomplete="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                    </div>
                    @error('username')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <input type="email" id="email" name="email" placeholder="budi@email.com" value="{{ old('email') }}" autocomplete="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                    </div>
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" id="password" name="password" placeholder="Min. 8 karakter" autocomplete="new-password" oninput="checkStrength(this.value)" class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <button type="button" class="toggle-pw" onclick="togglePw('password','eye1')" aria-label="Tampilkan kata sandi">
                            <svg id="eye1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="pw-strength">
                        <div class="pw-strength-bar">
                            <span id="s1"></span><span id="s2"></span><span id="s3"></span><span id="s4"></span>
                        </div>
                        <div class="pw-strength-label" id="s-label">Masukkan kata sandi</div>
                    </div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation','eye2')" aria-label="Tampilkan konfirmasi kata sandi">
                            <svg id="eye2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-divider"></div>

                <button type="submit" class="btn-primary">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                    Daftar Sekarang
                </button>

                <button type="button" class="btn-ghost" onclick="window.location.href='{{ url('/') }}'">
                    ← Kembali ke Beranda
                </button>
            </form>

            <div class="card-footer">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>

    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>

    <script>
        function togglePw(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            const show  = input.type === 'password';
            input.type  = show ? 'text' : 'password';
            icon.innerHTML = show
                ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
                : '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>';
        }

        function checkStrength(val) {
            const bars   = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
            const label  = document.getElementById('s-label');
            const colors = ['#ef4444','#f97316','#eab308','#22c55e'];
            const labels = ['Sangat lemah','Lemah','Cukup kuat','Kuat'];

            let score = 0;
            if (val.length >= 8)          score++;
            if (/[A-Z]/.test(val))        score++;
            if (/[0-9]/.test(val))        score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            bars.forEach((b, i) => {
                b.style.background = i < score ? colors[score - 1] : 'rgba(255,255,255,0.08)';
            });

            if (val.length === 0) {
                label.textContent = 'Masukkan kata sandi';
                label.style.color = 'rgba(255,255,255,0.3)';
            } else {
                label.textContent = labels[score - 1] || labels[0];
                label.style.color = colors[score - 1] || colors[0];
            }
        }
    </script>
</body>

</html>