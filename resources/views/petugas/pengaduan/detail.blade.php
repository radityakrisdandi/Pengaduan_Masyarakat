@extends('layout.app')

@section('content')
<style>
    /* Kontainer & Dasar Desain */
    .detail-container {
        padding: 2rem;
        background: #f8fafc;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    
    /* Tombol Kembali & Navigasi */
    .nav-back {
        margin-bottom: 1.5rem;
    }
    .btn-back {
        text-decoration: none !important;
        color: #4f46e5;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }
    .btn-back:hover {
        color: #4338ca;
        transform: translateX(-4px);
    }

    /* Kartu Informasi Utama */
    .info-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        margin-bottom: 2rem;
    }
    .category-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: #f1f5f9;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        display: inline-block;
        margin-bottom: 0.75rem;
    }
    .complaint-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    /* Metadata & Deskripsi */
    .meta-box {
        display: flex;
        gap: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        color: #64748b;
    }
    .description-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        color: #334155;
        line-height: 1.6;
        font-size: 0.95rem;
        white-space: pre-line;
        border: 1px solid #f1f5f9;
    }

    /* Foto Lampiran Bukti */
    .image-preview-container {
        margin-top: 1.5rem;
        max-width: 500px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    /* Riwayat Tanggapan (Timeline) */
    .timeline-section {
        margin-top: 2.5rem;
    }
    .timeline-item {
        background: #ffffff;
        border-left: 4px solid #4f46e5;
        padding: 1.25rem 1.5rem;
        border-radius: 0 12px 12px 0;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        border-top: 1px solid #f1f5f9;
        border-right: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Form Respon Petugas */
    .form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
    }
    .custom-textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        font-size: 0.95rem;
        transition: border-color 0.2s;
        outline: none;
    }
    .custom-textarea:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    .btn-submit {
        background: #4f46e5;
        color: #ffffff;
        border: none;
        padding: 0.85rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
    }
    .btn-submit:hover {
        background: #4338ca;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    /* Badge Status */
    .badge-status {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    .status-pending { background: #fff7ed; color: #c2410c; }
    .status-diproses { background: #eff6ff; color: #1d4ed8; }
    .status-selesai { background: #ecfdf5; color: #047857; }
</style>

<div class="detail-container">
    
    <div class="nav-back">
        <a href="{{ route('petugas.pengaduan.index') }}" class="btn-back">
            <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar Laporan
        </a>
    </div>

    @if(session('success'))
    <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #047857; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 600;">
        ✨ {{ session('success') }}
    </div>
    @endif

    <div class="info-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div class="category-label">
                📂 {{ $pengaduan->nama_kategori ?? 'Kategori Umum' }}
            </div>
            <div class="badge-status 
                {{ $pengaduan->status == 'pending' ? 'status-pending' : ($pengaduan->status == 'diproses' ? 'status-diproses' : 'status-selesai') }}">
                {{ $pengaduan->status }}
            </div>
        </div>
        
        <h1 class="complaint-title">{{ $pengaduan->judul }}</h1>

        <div class="meta-box">
            <div><strong>👤 Pelapor:</strong> {{ $pengaduan->nama_pelapor }}</div>
            <div><strong>📅 Tanggal:</strong> {{ date('d M Y, H:i', strtotime($pengaduan->created_at)) }}</div>
        </div>

        <p style="font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; font-size: 0.9rem;">Isi Laporan Masyarakat:</p>
        <div class="description-box">
            {{ $pengaduan->deskripsi }}
        </div>

        @if($pengaduan->foto)
        <p style="font-weight: 700; color: #1e293b; margin-top: 1.5rem; margin-bottom: 0.5rem; font-size: 0.9rem;">Lampiran Foto Bukti:</p>
        <div class="image-preview-container">
            @php
                $cleanPath = $pengaduan->foto;
                if (\Illuminate\Support\Str::contains($cleanPath, 'public/')) {
                    $cleanPath = str_replace('public/', '', $cleanPath);
                }
            @endphp
            <img src="{{ asset('storage/' . $cleanPath) }}" 
                 style="width: 100%; height: auto; display: block;" 
                 alt="Bukti Aduan"
                 onerror="this.onerror=null; this.src='{{ asset('storage/pengaduan/' . $cleanPath) }}';">
        </div>
        @endif
    </div>

    <div class="timeline-section">
        <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 1.25rem;">
            💬 Riwayat Tanggapan Tim
        </h3>
        @forelse($tanggapans as $tgp)
        <div class="timeline-item">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-weight: 800; color: #1e293b; font-size: 0.9rem;">{{ $tgp->nama_petugas }} <small style="color: #4f46e5; font-weight: 600;">(Staff)</small></span>
                <small style="color: #94a3b8;">{{ date('d M Y, H:i', strtotime($tgp->created_at)) }}</small>
            </div>
            <p style="margin: 0; color: #475569; font-size: 0.9rem; line-height: 1.5;">{{ $tgp->isi_tanggapan }}</p>
        </div>
        @empty
        <div style="text-align: center; padding: 2rem; color: #94a3b8; font-style: italic; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
            Belum ada tanggapan untuk laporan ini.
        </div>
        @endforelse
    </div>

    <div class="form-card" style="margin-top: 3rem;">
        <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem;">
            ✍️ Berikan Respon & Tindakan
        </h3>
        
        <form action="{{ route('petugas.tanggapan.store', $pengaduan->id) }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.5rem;">
                    Tulis Tanggapan Resmi :
                </label>
                <textarea name="isi_tanggapan" rows="4" class="custom-textarea" placeholder="Tuliskan jawaban klarifikasi atau langkah tindak lanjut lapangan..." required></textarea>
                @error('isi_tanggapan') <small style="color: #e11d48; font-weight: 600;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.75rem;">
                    Update Progres Status Laporan :
                </label>
                <div style="display: flex; gap: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #334155; font-weight: 600; font-size: 0.9rem;">
                        <input type="radio" name="status" value="diproses" {{ $pengaduan->status == 'diproses' ? 'checked' : '' }} style="accent-color: #4f46e5; width: 18px; height: 18px;">
                        ⚙️ Diproses
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #334155; font-weight: 600; font-size: 0.9rem;">
                        <input type="radio" name="status" value="selesai" {{ $pengaduan->status == 'selesai' ? 'checked' : '' }} style="accent-color: #059669; width: 18px; height: 18px;">
                        ✅ Selesai / Tuntas
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Kirim Tanggapan & Perbarui Progres
            </button>
        </form>
    </div>

</div>
@endsection