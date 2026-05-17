@extends('layout.app')

@section('content')
<style>
    .page-title {
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.5px;
    }
    
    /* Elegant Light Card */
    .card-stat {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    /* Light News Card */
    .card-news {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.2s;
    }
    .card-news:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -3px rgba(0, 0, 0, 0.08);
    }
    .news-img-holder {
        position: relative;
        height: 190px;
        background: #f1f5f9;
    }
    .news-img-holder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .badge-category {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #e0e7ff;
        color: #4f46e5;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Custom Badges untuk Status Pengaduan */
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .status-pending { background-color: #fef9c3; color: #a16207; }
    .status-diproses { background-color: #dbeafe; color: #1d4ed8; }
    .status-selesai { background-color: #dcfce7; color: #15803d; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">Dashboard</h2>
        <p class="text-muted mb-0">Selamat datang kembali, <span class="font-weight-semibold text-dark">{{ Auth::user()->name }}</span> ✨</p>
    </div>
    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 500;">
        <i class="mdi mdi-plus mr-1"></i> Buat Pengaduan Baru
    </a>
</div>

<div class="row mb-5">
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card-stat d-flex align-items-center">
            <div class="mr-3 d-flex align-items-center justify-content-center text-primary" style="width: 50px; height: 50px; background: #eff6ff; border-radius: 12px; font-size: 24px;">
                <i class="mdi mdi-file-document-multiple-outline"></i>
            </div>
            <div>
                <h3 class="mb-0 font-weight-bold text-dark">{{ $totalPengaduan }}</h3>
                <small class="text-muted">Total Pengaduan Anda</small>
            </div>
        </div>
    </div>
</div>

<div class="mb-4">
    <h5 class="font-weight-bold text-dark mb-3"><i class="mdi mdi-bullhorn text-primary mr-2"></i>Informasi & Pengumuman Terbaru</h5>
    <div class="row">
        @forelse($beritaTerbaru as $news)
            <div class="col-md-4 mb-4">
                <div class="card-news">
                    <div class="news-img-holder">
                        <span class="badge-category">Info Publik</span>
                        @if($news->gambar)
                            <img src="{{ asset('storage/' . $news->gambar) }}" alt="Gambar Berita">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted bg-light">
                                <i class="mdi mdi-image-outline" style="font-size: 32px;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <small class="text-muted mb-2"><i class="mdi mdi-calendar mr-1"></i>{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d M Y') }}</small>
                        <h6 class="font-weight-bold text-dark mb-2" style="line-height: 1.4;">{{ $news->judul }}</h6>
                        <p class="text-muted small mb-3">{{ Str::limit(strip_tags($news->isi_berita), 120) }}</p>
                        <a href="#" class="btn btn-light btn-sm mt-auto text-primary font-weight-bold" style="border-radius: 8px;">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded border" style="border-style: dashed !important;">
                    <i class="mdi mdi-newspaper-minus text-muted" style="font-size: 48px;"></i>
                    <p class="text-muted mt-2 mb-0">Belum ada informasi publik yang diterbitkan oleh admin.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
    <div class="card-body p-4 bg-white">
        <h5 class="font-weight-bold text-dark mb-4"><i class="mdi mdi-history text-primary mr-2"></i>5 Laporan Terbaru Anda</h5>
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="vertical-align: middle;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 text-muted small uppercase font-weight-bold" style="width: 80px;">No.</th>
                        <th class="border-0 text-muted small uppercase font-weight-bold">Judul Laporan</th>
                        <th class="border-0 text-muted small uppercase font-weight-bold">Kategori</th>
                        <th class="border-0 text-muted small uppercase font-weight-bold">Status</th>
                        <th class="border-0 text-muted small uppercase font-weight-bold">Tanggal Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduanTerbaru as $key => $aduan)
                        <tr>
                            <td class="text-dark font-weight-medium">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="text-dark font-weight-semibold">{{ $aduan->judul }}</td>
                            <td class="text-muted">{{ $aduan->nama_kategori ?? 'Umum' }}</td>
                            <td>
                                <span class="badge-status status-{{ $aduan->status }}">
                                    {{ ucfirst($aduan->status) }}
                                </span>
                            </td>
                            <td class="text-muted small">{{ \Carbon\Carbon::parse($aduan->created_at)->translatedFormat('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Anda belum pernah mengirimkan laporan pengaduan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection