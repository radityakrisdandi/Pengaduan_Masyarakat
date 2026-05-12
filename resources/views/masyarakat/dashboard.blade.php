@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <h1>Dashboard Masyarakat</h1>
            </div>
            <div class="col-12 grid-margin stretch-card">
                <h3>Selamat datang {{ Auth::user()->name ?? 'user' }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">24</h3>
                                </div>
                            </div>

                        </div>

                        <h6 class="text-muted font-weight-normal mt-2">Total Pengaduan</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pengaduan Terbaru</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No.</th>
                                        <th> Judul Aduan </th>
                                        <th> Status </th>
                                        <th> Tanggal </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 02312 </td>
                                        <td> Website </td>
                                        <td>
                                            <div class="badge badge-outline-success">Approved</div>
                                        </td>
                                        <td> Credit card </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
