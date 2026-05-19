@extends('layout.app')

@section('content')

<h3 class="mb-4 font-weight-bold">
    Dashboard Admin
</h3>

<div class="row">

    {{-- Total Pengaduan --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Pengaduan</small>
                        <h3 class="font-weight-bold mt-2">
                            {{ $totalPengaduan }}
                        </h3>
                    </div>

                    <i class="mdi mdi-file-document text-primary"
                        style="font-size: 2rem;"></i>
                </div>

            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Pending</small>
                        <h3 class="font-weight-bold mt-2">
                            {{ $pending }}
                        </h3>
                    </div>

                    <i class="mdi mdi-timer-sand text-warning"
                        style="font-size: 2rem;"></i>
                </div>

            </div>
        </div>
    </div>

    {{-- Diproses --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Diproses</small>
                        <h3 class="font-weight-bold mt-2">
                            {{ $diproses }}
                        </h3>
                    </div>

                    <i class="mdi mdi-progress-clock text-info"
                        style="font-size: 2rem;"></i>
                </div>

            </div>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Selesai</small>
                        <h3 class="font-weight-bold mt-2">
                            {{ $selesai }}
                        </h3>
                    </div>

                    <i class="mdi mdi-check-circle text-success"
                        style="font-size: 2rem;"></i>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection