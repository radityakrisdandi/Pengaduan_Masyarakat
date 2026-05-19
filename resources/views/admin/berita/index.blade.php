@extends('layout.app')

@section('content')

<h3 class="mb-4 font-weight-bold">
    Berita
</h3>

<div class="row">

    @forelse($semuaBerita as $berita)

        <div class="col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h5 class="font-weight-bold">
                        {{ $berita->judul }}
                    </h5>

                    <p class="text-muted">
                        {{ $berita->created_at->format('d M Y') }}
                    </p>

                    <p>
                        {{ Str::limit($berita->isi, 120) }}
                    </p>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info">
                Belum ada berita
            </div>

        </div>

    @endforelse

</div>

@endsection