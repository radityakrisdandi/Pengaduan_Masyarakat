@extends('layout.app')

@section('content')
<style>
    /* Desain Dasar Riwayat User Premium */
    .page-title {
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
    }

    .custom-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }

    /* Header Tabel Estetik */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    .custom-table th {
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
        padding: 1.2rem 1.5rem;
    }

    .custom-table td {
        padding: 1.25rem 1.5rem;
        vertical-align: top;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .custom-table tr:hover {
        background-color: #f8fafc;
    }

    /* Status Badges */
    .badge-status {
        padding: 0.4rem 0.85rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-pending { background-color: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .badge-proses { background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-selesai { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }

    /* Balasan/Feedback Real-time */
    .feedback-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        font-style: italic;
        color: #1e293b;
        font-weight: 600;
        font-size: 0.85rem;
        max-width: 320px;
        word-wrap: break-word;
    }
    
    .feedback-badge-info {
        font-size: 0.75rem;
        padding: 6px 10px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
    }
</style>

<div class="mb-4 d-flex align-items-center justify-content-between flex-wrap" style="gap: 15px;">
    <div>
        <h2 class="page-title mb-1">Riwayat Pengaduan Anda 📝</h2>
        <p class="text-muted mb-0">Pantau perkembangan, validasi, dan respons balik dari tim petugas lapangan secara real-time.</p>
    </div>
    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary px-4 d-flex align-items-center text-white"
        style="border-radius: 10px; font-weight: 600; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none; gap: 6px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
        <i class="mdi mdi-plus-box" style="font-size: 1.2rem;"></i> Buat Laporan Baru
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center"
        style="border-radius: 12px; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
        <i class="mdi mdi-check-circle-outline mr-2" style="font-size: 1.4rem; vertical-align: middle; margin-right: 8px;"></i>
        <div><strong>Sukses!</strong> {{ session('success') }}</div>
    </div>
@endif

<div class="card custom-card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th style="width: 20%;">Tanggal Pengajuan</th>
                        <th style="width: 25%;">Judul Laporan</th>
                        <th style="width: 15%;">Kategori</th>
                        <th style="width: 25%;">Tanggapan Petugas</th> 
                        <th style="width: 15%;" class="text-center">Status</th>
                        <th style="width: 10%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $index => $row)
                        <tr>
                            <td class="text-center font-weight-bold text-muted" style="vertical-align: middle;">{{ $index + 1 }}</td>
                            <td>
                                <strong style="color: #1e293b;">{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}</strong>
                                <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">{{ \Carbon\Carbon::parse($row->created_at)->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a; line-height: 1.4;">{{ $row->judul }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border px-2 py-1" style="border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                    {{ $row->kategori->nama_kategori ?? 'Umum' }}
                                </span>
                            </td>
                            <td>
                                {{-- REVISI PERMANEN: Menggunakan ->count() dan ->first() agar aman dari crash collection empty --}}
                                @if($row->tanggapan && $row->tanggapan->count() > 0)
                                    <div class="feedback-box">
                                        💬 "{!! e($row->tanggapan->first()->isi_tanggapan ?? $row->tanggapan->first()->tanggapan) !!}"
                                    </div>
                                    <div style="font-size: 0.7rem; color: #4f46e5; font-weight: 700; margin-top: 4px; text-transform: uppercase;">
                                        <i class="mdi mdi-account-badge-outline"></i> Respons Resmi Staff
                                    </div>
                                @else
                                    @if (strtolower($row->status) == 'pending' || $row->status == '0')
                                        <span class="feedback-badge-info" style="background-color: #fffbeb; color: #b45309;">
                                            ⏳ Menunggu verifikasi berkas
                                        </span>
                                    @elseif(strtolower($row->status) == 'proses' || strtolower($row->status) == 'diproses')
                                        <span class="feedback-badge-info" style="background-color: #eff6ff; color: #1d4ed8;">
                                            ⚙️ Sedang ditindaklanjuti lapangan
                                        </span>
                                    @else
                                        <span class="feedback-badge-info" style="background-color: #f1f5f9; color: #475569;">
                                            ❌ Belum ada lampiran feedback
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                @if (strtolower($row->status) == 'pending' || $row->status == '0')
                                    <span class="badge-status badge-pending">
                                        <i class="mdi mdi-clock-outline"></i> Pending
                                    </span>
                                @elseif(strtolower($row->status) == 'proses' || strtolower($row->status) == 'diproses')
                                    <span class="badge-status badge-proses">
                                        <i class="mdi mdi-cached"></i> Diproses
                                    </span>
                                @elseif(strtolower($row->status) == 'selesai')
                                    <span class="badge-status badge-selesai">
                                        <i class="mdi mdi-check-circle-outline"></i> Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <form action="{{ route('pengaduan.destroy', $row->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan & menghapus berkas pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger" style="text-decoration: none;" title="Hapus Pengaduan">
                                        <div style="width: 32px; height: 32px; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                                            <i class="mdi mdi-delete" style="font-size: 1.1rem;"></i>
                                        </div>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted mb-2">
                                    <i class="mdi mdi-comment-text-multiple-outline" style="font-size: 48px; color: #cbd5e1; display: block;"></i>
                                </div>
                                <h5 class="mb-1 text-secondary font-weight-bold">Belum Ada Riwayat Laporan</h5>
                                <p class="text-muted small mb-0">Semua aduan aspirasi yang Anda kirimkan ke instansi akan tercatat lengkap di halaman ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection