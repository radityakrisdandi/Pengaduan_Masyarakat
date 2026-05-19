@extends('layout.app')

@section('content')
    <h3 class="mb-4 font-weight-bold">
        Kelola Berita
    </h3>

    <div class="row">

        {{-- FORM TAMBAH --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="mb-3">
                        Tambah Berita
                    </h5>

                    <form action="{{ route('petugas.berita.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">

                            <label>Judul</label>

                            <input type="text" name="judul" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>Isi Berita</label>

                            <textarea name="isi_berita" rows="5" class="form-control"></textarea>

                        </div>
                        <div class="form-group">

                            <label>Gambar</label>

                            <input type="file" name="gambar" class="form-control">

                        </div>

                        <button type="submit" class="btn btn-primary btn-block">

                            Publish

                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- LIST BERITA --}}
        <div class="col-md-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="mb-3">
                        Daftar Berita
                    </h5>

                    @forelse($berita as $item)
                        <div class="border rounded p-3 mb-3">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <h5 class="font-weight-bold">
                                        {{ $item->judul }}
                                    </h5>

                                    <small class="text-muted">
                                        {{ $item->created_at->format('d M Y') }}
                                    </small>

                                </div>

                                <form action="{{ route('petugas.berita.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus berita ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">

                                        <i class="mdi mdi-delete"></i>

                                    </button>

                                </form>

                            </div>

                            <hr>
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid rounded mb-3"
                                    style="max-height: 250px; object-fit: cover; width: 100%;">
                            @endif

                            <p class="mb-0">
                                {{ $item->isi_berita }}
                            </p>

                        </div>

                    @empty

                        <div class="alert alert-info">
                            Belum ada berita
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

    </div>
@endsection
