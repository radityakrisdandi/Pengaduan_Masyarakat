@extends('layout.app')

@section('content')
<style>
    /* Desain Dasar Riwayat Fluida & Bernafas */
    .dashboard-container {
        padding: 2rem;
        background: #f8fafc;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    
    /* Banner Riwayat Premium Gradasi Gelap Elegan */
    .welcome-banner {
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        border-radius: 16px;
        padding: 2rem;
        color: #ffffff;
        margin-bottom: 2rem;
        box-shadow: 0 10px 25px -5px rgba(30, 41, 59, 0.15);
        position: relative;
        overflow: hidden;
    }

    /* Grid Statistik Otomatis yang Rapi */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

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

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .icon-all { background: #eef2ff; color: #4f46e5; }
    .icon-selesai { background: #ecfdf5; color: #059669; }
    .icon-calendar { background: #fffbeb; color: #d97706; }

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

    /* Card Filter Area */
    .filter-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }

    /* Table styling */
    .table-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .custom-table th {
        background: #f8fafc;
        padding: 1rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    .custom-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
        vertical-align: top;
    }
    .custom-table tr:hover {
        background-color: #f8fafc;
    }
</style>

<div class="dashboard-container">
    
    <div class="welcome-banner">
        <h1 style="font-size: 1.75rem; font-weight: 800; margin: 0;">
            Arsip & Riwayat Penanganan Feedback 📜
        </h1>
        <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: #cbd5e1; font-weight: 500;">
            Pemantauan rekapitulasi berkas aduan yang telah berhasil ditanggapi secara formal oleh jajaran tim lapangan.
        </p>
    </div>

    <div class="section-title">Ringkasan Riwayat Penanganan</div>
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-info">
                <p>Sudah Merespon</p>
                <h3>{{ isset($riwayat) ? count($riwayat) : 0 }}</h3>
                <span>Total berkas</span>
            </div>
            <div class="stat-icon icon-all">
                <i class="mdi mdi-history"></i>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #10b981;">
            <div class="stat-info">
                <p style="color: #059669;">Status Selesai</p>
                <h3 style="color: #047857;">
                    @php $tuntas = 0; @endphp
                    @if(isset($riwayat))
                        @foreach($riwayat as $r)
                            @if(strtolower($r->status ?? '') == 'selesai') @php $tuntas++; @endphp @endif
                        @endforeach
                    @endif
                    {{ $tuntas }} Berkas
                </h3>
                <span>Laporan ditutup</span>
            </div>
            <div class="stat-icon icon-selesai">
                <i class="mdi mdi-check-circle-outline"></i>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f59e0b;">
            <div class="stat-info">
                <p style="color: #d97706;">Rentang Tanggal</p>
                <h3 style="font-size: 1.15rem; margin-top: 0.6rem; color: #b45309;">
                    {{ (isset($startDate) && $startDate) && (isset($endDate) && $endDate) ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') . ' - ' . \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Semua Waktu' }}
                </h3>
                <span>Filter aktif</span>
            </div>
            <div class="stat-icon icon-calendar">
                <i class="mdi mdi-calendar-range"></i>
            </div>
        </div>
    </div>

    <div class="section-title">Saring Berdasarkan Periode</div>
    <div class="filter-card">
        <form action="{{ route('petugas.riwayat.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: flex-end;">
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem;">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate ?? '' }}" style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; background: #f8fafc;">
            </div>
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem;">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate ?? '' }}" style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; background: #f8fafc;">
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" style="background: #4f46e5; color: #fff; font-weight: 600; padding: 0.65rem 1.5rem; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="mdi mdi-filter-outline"></i> Filter Data
                </button>
                @if((isset($startDate) && $startDate) || (isset($endDate) && $endDate))
                    <a href="{{ route('petugas.riwayat.index') }}" style="background: #e2e8f0; color: #475569; font-weight: 600; padding: 0.65rem 1.25rem; border-radius: 8px; text-decoration: none; text-align: center;">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="section-title">Log Record Tanggapan Keluar</div>
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 15%;">Tanggal Respon</th>
                    <th style="width: 20%;">Masyarakat (Pelapor)</th>
                    <th style="width: 20%;">Judul Aduan</th>
                    <th style="width: 30%;">Isi Feedback Petugas</th>
                    <th style="width: 15%; text-align: center;">Status Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat ?? [] as $row)
                    <tr>
                        <td>
                            <strong style="color: #1e293b;">{{ \Carbon\Carbon::parse($row->tanggal_tanggapan)->format('d M Y') }}</strong>
                            <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">{{ \Carbon\Carbon::parse($row->tanggal_tanggapan)->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #334155;">{{ $row->nama_pelapor ?? $row->user->name ?? 'Masyarakat' }}</div>
                            <div style="font-size: 0.75rem; color: #64748b;">ID Akun Terverifikasi</div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #0f172a;">{{ $row->judul_pengaduan ?? $row->pengaduan->judul_laporan ?? 'Aduan Masyarakat' }}</div>
                        </td>
                        <td>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 0.75rem 1rem; border-radius: 10px; font-style: italic; color: #475569;">
                                "{{ $row->isi_tanggapan }}"
                            </div>
                            <div style="font-size: 0.7rem; color: #4f46e5; font-weight: 700; margin-top: 5px; text-transform: uppercase;">
                                <i class="mdi mdi-account-tie"></i> Oleh: {{ $row->nama_petugas ?? 'Anda sendiri' }}
                            </div>
                        </td>
                        <td style="text-align: center;">
                            @if(strtolower($row->status ?? '') == 'selesai')
                                <span style="display: inline-block; background: #ecfdf5; color: #065f46; font-weight: 700; font-size: 0.75rem; padding: 0.4rem 1rem; border-radius: 30px; border: 1px solid #a7f3d0;">
                                    Selesai
                                </span>
                            @else
                                <span style="display: inline-block; background: #eff6ff; color: #1e40af; font-weight: 700; font-size: 0.75rem; padding: 0.4rem 1rem; border-radius: 30px; border: 1px solid #bfdbfe;">
                                    {{ ucfirst($row->status ?? 'Proses') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            <i class="mdi mdi-comment-remove-outline" style="font-size: 2.5rem; display: block; margin-bottom: 0.5rem;"></i>
                            Tidak ditemukan data riwayat tanggapan pada periode penanggalan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection