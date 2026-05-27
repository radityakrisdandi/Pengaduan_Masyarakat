@extends('layout.app')

@section('content')
    <h3 class="mb-4 font-weight-bold">
        Log Aktivitas
    </h3>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">
                @if (auth()->user()->role == 'admin')
                    <form method="GET" class="mb-4">

                        <div class="row">

                            <div class="col-md-4">

                                <input type="text" name="search" class="form-control" placeholder="Cari nama..."
                                    value="{{ request('search') }}">

                            </div>

                            <div class="col-md-3">

                                <select name="role" class="form-control">

                                    <option value="">
                                        Semua Role
                                    </option>

                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>
                                        Petugas
                                    </option>

                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>
                                        User
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-2">

                                <button type="submit" class="btn btn-primary btn-block">

                                    Filter

                                </button>

                            </div>

                        </div>

                    </form>
                @endif

                <table class="table table-bordered">

                    <thead class="bg-light">

                        <tr>

                            <th width="80">
                                No
                            </th>

                            @if (auth()->user()->role == 'admin')
                                <th>
                                    Nama
                                </th>

                                <th>
                                    Role
                                </th>
                            @endif

                            <th>
                                Aktivitas
                            </th>

                            <th width="220">
                                Waktu
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($logs as $index => $log)
                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                @if (auth()->user()->role == 'admin')
                                    <td>
                                        {{ $log->user->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ ucfirst($log->user->role ?? '-') }}
                                    </td>
                                @endif

                                <td>
                                    {{ $log->aktivitas }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d F Y H:i') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    Belum ada aktivitas

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
