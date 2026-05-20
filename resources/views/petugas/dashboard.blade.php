@extends('layout.app')

@section('content')
<style>
    /* Desain Dasar Dashboard Fluida & Bernafas */
    .dashboard-container {
        padding: 2rem;
        background: #f8fafc;
        min-h: 100vh;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    
    /* Banner Selamat Datang Premium Gradasi Cerah */
    .welcome-banner {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 2rem;
        color: #ffffff;
        margin-bottom: 2rem;
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.15);
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    /* Grid Statistik Otomatis yang Rapi & Tidak Kaku */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* Kartu Statistik Berwarna-warni Lembut (Glow Efek) */
    .stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.05);
    }
    .stat-info h3 {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0.25rem 0;
    }
    .stat-info p {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0;
    }
    .stat-info span {
        font-size: 0.75rem;
        color: #64748b;
    }

    /* Lingkaran Ikon Indikator Warna */
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .icon-all { bg-color: #eef2ff; color: #4f46e5; background: #eef2ff; }
    .icon-pending { bg-color: #fffbeb; color: #d97706; background: #fffbeb; }
    .icon-proses { bg-color: #eff6ff; color: #2563eb; background: #eff6ff; }
    .icon-selesai { bg-color: #ecfdf5; color: #059669; background: #ecfdf5; }

    /* Area Menu Navigasi Cepat */
    .section-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .menu-button {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        gap: 1.25rem;
        text-decoration: none !important;
        color: inherit;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .menu-button:hover {
        border-color: #cbd5e1;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
        transform: scale(1.01);
    }
    .menu-icon-box {
        padding: 0.75rem;
        border-radius: 12px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .menu-text h4 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 0.25rem 0;
    }
    .menu-text p {
        font-size: 0.8rem;
        color: #64748b;
        margin: 0;
        line-height: 1.4;
    }
</style>

<div class="dashboard-container">
    
    <div class="welcome-banner">
        <h1 style="font-size: 1.75rem; font-weight: 800; margin: 0;">
            Selamat Datang Kembali, <span style="color: #fcd34d;">{{ Auth::user()->name ?? 'Staff' }}</span>! ✨
        </h1>
        <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: #e0e7ff; font-weight: 500;">
            Panel Pemantauan Aspirasi. Mari berikan respons terbaik, transparan, dan cepat untuk masyarakat hari ini.
        </p>
    </div>

    <div class="section-title">Statistik Pengaduan Hari Ini</div>

    <div class="stat-grid">
        
        <div class="stat-card">
            <div class="stat-info">
                <p>Total Aduan</p>
                <h3>{{ $totalPengaduan ?? 0 }}</h3>
                <span>Seluruh berkas</span>
            </div>
            <div class="stat-icon icon-all">
                <i class="mdi mdi-folder-multiple"></i>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f59e0b;">
            <div class="stat-info">
                <p style="color: #d97706;">Pending</p>
                <h3 style="color: #b45309;">{{ $totalPending ?? 0 }}</h3>
                <span style="color: #d97706; font-weight: 600; background: #fffbeb; padding: 1px 6px; border-radius: 4px;">Verifikasi</span>
            </div>
            <div class="stat-icon icon-pending">
                <i class="mdi mdi-clock-outline"></i>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #3b82f6;">
            <div class="stat-info">
                <p style="color: #2563eb;">Diproses</p>
                <h3 style="color: #1d4ed8;">{{ $totalProses ?? 0 }}</h3>
                <span>Tindakan lapangan</span>
            </div>
            <div class="stat-icon icon-proses">
                <i class="mdi mdi-progress-wrench"></i>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #10b981;">
            <div class="stat-info">
                <p style="color: #059669;">Selesai</p>
                <h3 style="color: #047857;">{{ $totalSelesai ?? 0 }}</h3>
                <span style="color: #059669; font-weight: 600; background: #ecfdf5; padding: 1px 6px; border-radius: 4px;">Tuntas</span>
            </div>
            <div class="stat-icon icon-selesai">
                <i class="mdi mdi-check-circle-outline"></i>
            </div>
        </div>

    </div>

    <div class="section-title">Aksi Cepat Operasional</div>

    <div class="menu-grid">
        
        <a href="{{ route('petugas.pengaduan.index') }}" class="menu-button">
            <div class="menu-icon-box" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);">
                <i class="mdi mdi-file-document-edit-outline" style="font-size: 1.5rem; flex-shrink: 0;"></i>
            </div>
            <div class="menu-text">
                <h4>Validasi Pengaduan Masuk</h4>
                <p>Periksa keaslian laporan masyarakat, verifikasi foto lampiran, dan publikasikan lembar tanggapan resmi.</p>
            </div>
        </a>

        <a href="{{ route('petugas.riwayat.index') }}" class="menu-button">
            <div class="menu-icon-box" style="background: linear-gradient(135deg, #1e293b 0%, #475569 100%);">
                <i class="mdi mdi-history" style="font-size: 1.5rem; flex-shrink: 0;"></i>
            </div>
            <div class="menu-text">
                <h4>Arsip & Riwayat Kerja</h4>
                <p>Melihat rekap tanggapan masa lalu yang pernah Anda kirimkan lengkap menggunakan filter urutan tanggal berkala.</p>
            </div>
        </a>

    </div>

</div>
@endsection