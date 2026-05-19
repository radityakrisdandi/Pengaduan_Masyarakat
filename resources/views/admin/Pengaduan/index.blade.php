@extends('layout.app')

@section('content')
    <h3 class="mb-4 font-weight-bold">
        Monitoring Pengaduan
    </h3>

    <div class="row">

        {{-- FILTER & KATEGORI --}}
        <div class="col-md-4">

            {{-- FILTER --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <h5 class="mb-3">
                        Filter Pengaduan
                    </h5>

                    <form method="GET" action="{{ route('admin.pengaduan.index') }}">

                        {{-- Filter Kategori --}}
                        <div class="form-group">

                            <label>Kategori</label>

                            <select name="kategori_id" class="form-control">

                                <option value="">
                                    Semua Kategori
                                </option>

                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('kategori_id') == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_kategori }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- Filter Status --}}
                        <div class="form-group">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>

                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>

                        </div>

                        <button type="submit" class="btn btn-primary btn-block">

                            Filter

                        </button>

                    </form>

                </div>
            </div>

            {{-- KELOLA KATEGORI --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="mb-3">
                        Kelola Kategori
                    </h5>

                    {{-- FORM TAMBAH --}}
                    <form action="{{ route('admin.kategori.store') }}" method="POST">

                        @csrf

                        <div class="form-group">

                            <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori">

                        </div>

                        <button type="submit" class="btn btn-success btn-block">

                            Tambah

                        </button>

                    </form>

                    <hr>

                    {{-- DAFTAR KATEGORI --}}
                    <h6 class="mb-3">
                        Daftar Kategori
                    </h6>

                    @forelse($kategori as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">

                            <span>
                                {{ $item->nama_kategori }}
                            </span>

                            <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus kategori ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">

                                    <i class="mdi mdi-delete"></i>

                                </button>

                            </form>

                        </div>

                    @empty

                        <p class="text-muted">
                            Belum ada kategori
                        </p>
                    @endforelse

                </div>

            </div>
        </div>

        {{-- TABEL PENGADUAN --}}
        <div class="col-md-8">

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h5 class="mb-3">
                        Data Pengaduan
                    </h5>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pelapor</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($pengaduan as $index => $row)
                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
                                        </td>

                                        <td>
                                            {{ $row->user->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $row->judul }}
                                        </td>

                                        <td>
                                            {{ $row->kategori->nama_kategori ?? '-' }}
                                        </td>

                                        <td>

                                            @if ($row->status == 'pending')
                                                <span class="badge badge-warning">
                                                    Pending
                                                </span>
                                            @elseif($row->status == 'diproses')
                                                <span class="badge badge-info">
                                                    Diproses
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    Selesai
                                                </span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center">

                                            Belum ada pengaduan

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
@endsection
