@extends('layout.app')

@section('content')
<style>
    /* Kontainer Utama & Tipografi */
    .table-container {
        padding: 2rem;
        background: #f8fafc;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    
    /* Header Halaman */
    .page-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-title h1 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }
    .page-title p {
        font-size: 0.875rem;
        color: #64748b;
        margin: 0.25rem 0 0 0;
    }

    /* Pembungkus Tabel / List Kartu */
    .custom-card-table {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }

    /* Style Tabel Responsif Modern */
    .responsive-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .responsive-table th {
        background: #f1f5f9;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .responsive-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .responsive-table tr:last-child td {
        border-bottom: none;
    }
    .responsive-table tr:hover td {
        background: #f8fafc;
    }

    /* Desain Badge Status */
    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .badge-pending { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-proses { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-selesai { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }

    /* Tombol Aksi */
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #ffffff;
        color: #4f46e5;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.825rem;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-action:hover {
        background: #4f46e5;
        color: #ffffff;
        border-color: #4f46e5;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    /* Kategori Tag */
    .badge-category {
        background: #f1f5f9;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.15rem 0.5rem;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="table-container">
    
    <div class="page-header">
        <div class="page-title">
            <h1>Daftar Pengaduan Masuk</h1>
            <p>Kelola, tinjau, dan tindak lanjuti seluruh laporan aspirasi yang dikirimkan oleh masyarakat.</p>
        </div>
    </div>

    @if(session('success'))
    <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #047857; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500;">
        {{ session('success') }}
    </div>
    @endif

    <div class="custom-card-table">
        <div style="overflow-x: auto;">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th style="width: 60px; text-align: center;">No</th>
                        <th>Judul Laporan</th>
                        <th>Kategori</th>
                        <th>Nama Pelapor</th>
                        <th>Tanggal Masuk</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center; width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listPengaduan as $index => $p)
                    <tr>
                        <td style="text-align: center; font-weight: 700; color: #94a3b8;">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #1e293b; max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $p->judul }}
                            </div>
                            <small style="color: #64748b; display: block; max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: 2px;">
                                {{ $p->deskripsi }}
                            </small>
                        </td>
                        <td>
                            <span class="badge-category">
                                {{ $p->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>
                        <td style="font-weight: 500; color: #475569;">
                            {{ $p->nama_pelapor }}
                        </td>
                        <td style="color: #64748b; font-size: 0.85rem;">
                            {{ date('d M Y H:i', strtotime($p->created_at)) }}
                        </td>
                        <td style="text-align: center;">
                            @if($p->status == 'pending')
                                <span class="badge-status badge-pending">⏳ Pending</span>
                            @elseif($p->status == 'diproses')
                                <span class="badge-status badge-proses">⚙️ Diproses</span>
                            @else
                                <span class="badge-status badge-selesai">✅ Selesai</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('petugas.pengaduan.detail', $p->id) }}" class="btn-action">
                                <i class="mdi mdi-eye-outline"></i> Detail & Respon
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 3rem 0; color: #94a3b8;">
                            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📁</div>
                            <div style="font-weight: 600; font-size: 0.95rem; color: #64748b;">Belum Ada Pengaduan Masuk</div>
                            <p style="margin: 0.25rem 0 0 0; font-size: 0.85rem; color: #cbd5e1;">Seluruh laporan masyarakat yang masuk akan terdaftar di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection