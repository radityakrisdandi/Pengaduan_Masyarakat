@extends('layout.app')

@section('content')
<style>
    .page-title {
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.5px;
    }
    .form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 0.6rem 1rem;
        height: auto;
        color: #334155;
    }
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    label {
        font-weight: 600;
        color: #334155;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
</style>

<div class="mb-4">
    <h2 class="page-title mb-1">Buat Pengaduan Baru</h2>
    <p class="text-muted">Sampaikan laporan atau keluhan Anda secara jelas dan benar.</p>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card form-card border-0">
            <div class="card-body p-4">
                
                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label for="judul">Judul Laporan / Pengaduan</label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" 
                               placeholder="Contoh: Jalan Rusak di RT 03" value="{{ old('judul') }}" required>
                        @error('judul')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="kategori_id">Kategori Pengaduan</label>
                        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori Laporan --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori ?? $kat->kategori ?? $kat->nama ?? 'Kategori ID: ' . $kat->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="deskripsi">Isi / Deskripsi Pengaduan</label>
                        <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control @error('deskripsi') is-invalid @enderror" 
                                  placeholder="Tuliskan secara rinci kronologi, lokasi kejadian, atau detail keluhan Anda..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="foto">Foto Bukti Pendukung <span class="text-muted font-weight-normal">(Optional)</span></label>
                        <input type="file" name="foto" id="foto" class="form-control-file d-block @error('foto') is-invalid @enderror">
                        <small class="text-muted d-block mt-2">Format yang didukung: JPG, JPEG, PNG. Maksimal ukuran file 2MB.</small>
                        @error('foto')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end border-top pt-3" style="gap: 10px;">
                        <a href="{{ route('masyarakat.dashboard') }}" class="btn btn-light px-4" style="border-radius: 8px; font-weight: 500;">Batal</a>
                        <button type="submit" class="btn btn-primary px-4" style="border-radius: 8px; font-weight: 500; background: #4f46e5; border-color: #4f46e5;">
                            <i class="mdi mdi-send mr-1"></i> Kirim Laporan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection