@extends('layout.app')

@section('content')
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">Kelola Berita & Informasi</h3>
        <p class="text-muted">Buat, filter, edit, dan hapus pengumuman resmi yang akan tampil di halaman masyarakat.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="border-radius: 10px;">
            <i class="mdi mdi-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold text-dark mb-3"><i class="mdi mdi-plus-box text-primary mr-2"></i>Tambah
                        Berita</h5>
                    <hr>
                    <form action="{{ route('petugas.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-secondary">Judul Berita</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                placeholder="Masukkan judul..." value="{{ old('judul') }}" required
                                style="border-radius: 8px;">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-secondary">Isi Berita</label>
                            <textarea name="isi_berita" rows="6" class="form-control @error('isi_berita') is-invalid @enderror"
                                placeholder="Tulis isi informasi di sini..." required style="border-radius: 8px;">{{ old('isi_berita') }}</textarea>
                            @error('isi_berita')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold small text-secondary">Gambar Pendukung</label>
                            <input type="file" name="gambar"
                                class="form-control-file @error('gambar') is-invalid @enderror">
                            <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG (Maks 2MB)</small>
                            @error('gambar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"
                            style="border-radius: 8px;">
                            <i class="mdi mdi-publish mr-1"></i> Terbitkan Berita
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                        <h5 class="font-weight-bold text-dark mb-3 mb-md-0"><i
                                class="mdi mdi-newspaper text-primary mr-2"></i>Daftar Berita</h5>

                        <form action="{{ route('petugas.berita.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control bg-light border-grey"
                                    placeholder="Cari judul berita..." value="{{ request('search') }}"
                                    style="border-radius: 8px 0 0 8px; font-size: 0.9rem;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 0 8px 8px 0;">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                            @if (request('search'))
                                <a href="{{ route('petugas.berita.index') }}"
                                    class="btn btn-sm btn-link text-danger ml-2">Reset</a>
                            @endif
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted uppercase small font-weight-bold">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th style="width: 100px;">Gambar</th>
                                    <th>Detail Berita</th>
                                    <th style="width: 140px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berita as $key => $item)
                                    <tr>
                                        <td>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                    class="rounded shadow-sm"
                                                    style="width: 70px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                                    style="width: 70px; height: 50px;">
                                                    <i class="mdi mdi-image-off-outline" style="font-size: 18px;"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <h6 class="font-weight-bold mb-1 text-dark text-truncate"
                                                style="max-width: 250px;">{{ $item->judul }}</h6>
                                            <small class="text-muted d-block mb-1"><i
                                                    class="mdi mdi-calendar-range mr-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</small>
                                            <div class="d-none isi-berita-mentah">
                                                {{ $item->isi_berita ?? ($item->isi ?? $item->konten) }}</div>
                                            <p class="text-muted mb-0 small text-truncate" style="max-width: 300px;">
                                                {{ strip_tags($item->isi_berita ?? ($item->isi ?? $item->konten)) }}</p>
                                            <p class="text-muted small">
                                                Diupdate pada:
                                                {{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->translatedFormat('l d F Y, H:i') }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-warning btn-edit-berita mr-1"
                                                    data-id="{{ $item->id }}" data-judul="{{ $item->judul }}"
                                                    data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                    data-toggle="modal" data-target="#modalEditBerita"
                                                    style="border-radius: 6px;">
                                                    <i class="mdi mdi-pencil"></i> Edit
                                                </button>

                                                <form action="{{ route('petugas.berita.destroy', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        style="border-radius: 6px;">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="mdi mdi-text-box-remove-outline d-block mb-2"
                                                style="font-size: 36px;"></i>
                                            Tidak ditemukan berita yang sesuai.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditBerita" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0" style="border-radius: 12px;">
                <div class="modal-header bg-light">
                    <h5 class="modal-title font-weight-bold text-dark"><i
                            class="mdi mdi-pencil text-warning mr-2"></i>Edit Berita & Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditBerita" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-secondary">Judul Berita</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control" required
                                style="border-radius: 8px;">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-secondary">Isi Berita</label>
                            <textarea name="isi_berita" id="edit_isi_berita" rows="6" class="form-control" required
                                style="border-radius: 8px;"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label class="font-weight-bold small text-secondary">Ganti Gambar Baru <span
                                    class="text-muted">(Opsional)</span></label>
                            <input type="file" name="gambar" class="form-control-file">
                        </div>
                        <div class="mb-1">
                            <label class="font-weight-bold small text-secondary d-block">Gambar Saat Ini:</label>
                            <div id="wrapper_preview_gambar" class="mt-2" style="display: none;">
                                <img id="edit_preview_gambar" src="" class="img-thumbnail rounded"
                                    style="max-height: 120px; object-fit: cover;">
                            </div>
                            <small id="no_image_text" class="text-muted style-italic" style="display: none;">Tidak ada
                                gambar sebelumnya</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-warning font-weight-bold px-4"
                            style="border-radius: 8px;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-edit-berita', function() {
                // 1. Ambil data langsung dari element baris tabel HTML yang diklik
                var beritaId = $(this).data('id');
                var judul = $(this).data('judul');
                var gambarPath = $(this).data('gambar');

                // Mengambil teks isi berita dari class d-none di kolom tabel yang sebaris
                var isiBerita = $(this).closest('tr').find('.isi-berita-mentah').text().trim();

                // 2. Set action form update route
                $('#formEditBerita').attr('action', '/petugas/berita/' + beritaId);

                // 3. Masukkan data ke dalam field input modal secara instan
                $('#edit_judul').val(judul);
                $('#edit_isi_berita').val(isiBerita);

                // 4. Logika pratinjau gambar
                if (gambarPath) {
                    $('#edit_preview_gambar').attr('src', gambarPath);
                    $('#wrapper_preview_gambar').show();
                    $('#no_image_text').hide();
                } else {
                    $('#edit_preview_gambar').attr('src', '');
                    $('#wrapper_preview_gambar').hide();
                    $('#no_image_text').show();
                }
            });
        });
    </script>
@endsection
