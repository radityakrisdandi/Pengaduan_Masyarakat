@extends('layout.app')

@section('content')
    <h3 class="mb-4 font-weight-bold">
        Manajemen User
    </h3>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="250">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $index => $row)
                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $row->name }}
                                </td>

                                <td>
                                    {{ $row->email }}
                                </td>

                                <td>
                                    <span class="badge badge-primary">
                                        {{ ucfirst($row->role) }}
                                    </span>
                                </td>

                                <td>

                                    {{-- UPDATE ROLE --}}
                                    <form action="{{ route('admin.user.role', $row->id) }}" method="POST" class="d-inline">

                                        @csrf
                                        @method('PUT')

                                        <div class="d-flex align-items-center">

                                            <select name="role" class="form-control form-control-sm mr-2">

                                                <option value="user" {{ $row->role == 'user' ? 'selected' : '' }}>
                                                    User
                                                </option>

                                                <option value="petugas" {{ $row->role == 'petugas' ? 'selected' : '' }}>
                                                    Petugas
                                                </option>

                                                <option value="admin" {{ $row->role == 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>

                                            </select>

                                            <button type="submit" class="btn btn-sm btn-info">

                                                Update

                                            </button>



                                    </form>
                                    {{-- HAPUS USER --}}
                                    <form action="{{ route('admin.user.destroy', $row->id) }}" method="POST"
                                        class="d-inline ml-2" onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">

                                            <i class="mdi mdi-delete"></i>

                                        </button>

                                    </form>
            </div>



            </td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="text-center">

                    Belum ada user

                </td>

            </tr>
            @endforelse

            </tbody>

            </table>

        </div>

    </div>

    </div>
@endsection
