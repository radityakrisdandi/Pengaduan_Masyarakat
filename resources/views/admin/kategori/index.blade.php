@extends('layout.app')

@section('content')

<h3 class="mb-4 font-weight-bold">
    Kategori Pengaduan
</h3>

<div class="row">

    {{-- FORM TAMBAH --}}
    <div class="col-md-4">

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h5 class="mb-3">
                    Tambah Kategori
                </h5>

                <form action="{{ route('admin.kategori.store') }}"
                    method="POST">

                    @csrf

                    <div class="form-group">
                        <label>Nama Kategori</label>

                        <input type="text"
                            name="nama_kategori"
                            class="form-control"
                            placeholder="Masukkan kategori">
                    </div>

                    <button type="submit"
                        class="btn btn-primary btn-block">

                        Tambah
                    </button>

                </form>

            </div>
        </div>

    </div>

    {{-- TABEL --}}
    <div class="col-md-8">

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h5 class="mb-3">
                    Daftar Kategori
                </h5>

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Kategori</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($kategori as $index => $row)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        {{ $row->nama_kategori }}
                                    </td>

                                    <td>

                                        <form action="{{ route('admin.kategori.destroy', $row->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-danger btn-sm">

                                                <i class="mdi mdi-delete"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3"
                                        class="text-center">

                                        Belum ada kategori

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