@extends('layout.app')

@section('content')
<style>
    .page-title {
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.5px;
    }
    .news-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.05);
        border-color: #cbd5e1;
    }
    .news-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.4;
    }
    .news-meta {
        font-size: 0.8rem;
        color: #64748b;
    }
    /* Membatasi teks deskripsi maksimal 2 baris agar tinggi kartu tetap rapi */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>

<div class="mb-4">
    <h2 class="page-title mb-1">Berita & Informasi</h2>
    <p class="text-muted mb-0">Informasi terbaru, pengumuman, dan berita seputar pelayanan masyarakat.</p>
</div>

<div class="row">
    @forelse($semuaBerita as $berita)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card news-card h-100 border-0 shadow-sm">
                @if(!empty($berita->foto))
                    <img src="{{ asset('storage/' . $berita->foto) }}" class="card-img-top" alt="Foto Berita" style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                        <i class="mdi mdi-image-broken-variant" style="font-size: 3rem; color: #cbd5e1;"></i>
                    </div>
                @endif
                
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <div class="news-meta mb-2 d-flex align-items-center">
                            <i class="mdi mdi-calendar-range mr-1"></i>
                            <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                        </div>
                        <h5 class="news-title mb-2 text-truncate-2" title="{{ $berita->judul }}">{{ $berita->judul }}</h5>
                        <p class="text-muted small mb-4">
                            {{ Str::limit(strip_tags($berita->isi), 100, '...') }}
                        </p>
                    </div>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#modalBerita{{ $berita->id }}" style="border-radius: 8px; font-weight: 500;">
                        Baca Selengkapnya
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalBerita{{ $berita->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
                    <div class="modal-header bg-light border-bottom-0 p-3">
                        <h5 class="modal-title font-weight-bold text-dark">Detail Informasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        @if(!empty($berita->foto))
                            <img src="{{ asset('storage/' . $berita->foto) }}" class="img-fluid rounded mb-3 w-100" style="max-height: 350px; object-fit: cover;">
                        @endif
                        <div class="news-meta mb-2">
                            <i class="mdi mdi-calendar-range mr-1"></i> {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y, H:i') }} WIB
                        </div>
                        <h3 class="font-weight-bold mb-3 text-dark">{{ $berita->judul }}</h3>
                        <hr class="my-3">
                        <div class="text-secondary" style="line-height: 1.6; font-size: 0.95rem; white-space: pre-line;">
                            {{ $berita->isi }}
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted mb-2">
                <i class="mdi mdi-newspaper-variant-outline" style="font-size: 50px; color: #cbd5e1;"></i>
            </div>
            <h5 class="text-secondary font-weight-semibold">Belum Ada Berita</h5>
            <p class="text-muted small">Pengumuman atau informasi resmi dari petugas/admin akan muncul di sini.</p>
        </div>
    @endforelse
</div>
@endsection