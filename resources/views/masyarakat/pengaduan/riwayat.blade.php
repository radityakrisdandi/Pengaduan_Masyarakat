@extends('layout.app')

@section('content')
    <style>
        .page-title {
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .custom-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .table thead th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.2rem 1rem;
        }

        .table tbody td {
            padding: 1.2rem 1rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-status {
            padding: 0.4rem 0.85rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-proses {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .badge-selesai {
            background-color: #dcfce7;
            color: #16a34a;
        }
    </style>

    <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap" style="gap: 15px;">
        <div>
            <h2 class="page-title mb-1">Riwayat Pengaduan</h2>
            <p class="text-muted mb-0">Pantau perkembangan dan status penanganan semua laporan Anda.</p>
        </div>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary px-4 d-flex align-items-center text-white"
            style="border-radius: 8px; font-weight: 500; background: #4f46e5; border-color: #4f46e5; gap: 5px;">
            <i class="mdi mdi-plus-box" style="font-size: 1.1rem;"></i> Buat Pengaduan Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center"
            style="border-radius: 12px; background: #dcfce7; color: #15803d;">
            <i class="mdi mdi-check-circle mr-2" style="font-size: 1.3rem;"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="card custom-card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 70px;" class="text-center">No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Judul Laporan</th>
                            <th>Kategori</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $index => $row)
                            <tr>
                                <td class="text-center font-weight-medium text-muted">{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                                <td class="font-weight-semibold text-dark">{{ $row->judul }}</td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1"
                                        style="border-radius: 6px; font-weight: 500;">
                                        {{ $row->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($row->status == 'pending')
                                        <span class="badge-status badge-pending">
                                            <i class="mdi mdi-clock-outline"></i> Pending
                                        </span>
                                    @elseif($row->status == 'diproses')
                                        <span class="badge-status badge-proses">
                                            <i class="mdi mdi-cached"></i> Diproses
                                        </span>
                                    @elseif($row->status == 'selesai')
                                        <span class="badge-status badge-selesai">
                                            <i class="mdi mdi-check-circle-outline"></i> Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('pengaduan.destroy', $row->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                style="border-radius: 8px;">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted mb-2">
                                        <i class="mdi mdi-comment-text-multiple-outline"
                                            style="font-size: 45px; color: #cbd5e1;"></i>
                                    </div>
                                    <h5 class="mb-1 text-secondary font-weight-semibold">Belum Ada Riwayat</h5>
                                    <p class="text-muted small mb-0">Semua laporan yang Anda kirimkan melalui form akan
                                        tercatat
                                        di sini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
