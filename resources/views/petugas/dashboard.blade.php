@extends('layout.app') {{-- Master layout kelompokmu --}}

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 border-b border-[#e2e8f0] pb-5">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Selamat Datang, Staff Petugas</h1>
            <p class="mt-2 text-sm text-slate-500">Berikut adalah ringkasan perkembangan laporan pengaduan masyarakat hari ini.</p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            
            <div class="bg-white rounded-xl border border-[#e2e8f0] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Pengaduan</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalPengaduan }}</p>
            </div>

            <div class="bg-white rounded-xl border border-[#e2e8f0] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-500">Pending</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalPending }}</p>
            </div>

            <div class="bg-white rounded-xl border border-[#e2e8f0] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-blue-500">Diproses</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalProses }}</p>
            </div>

            <div class="bg-white rounded-xl border border-[#e2e8f0] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Selesai</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalSelesai }}</p>
            </div>

        </div>

        <div class="bg-white rounded-xl border border-[#e2e8f0] p-6 shadow-sm">
            <h3 class="text-base font-semibold text-slate-950 mb-2">Manajemen Laporan</h3>
            <p class="text-sm text-slate-500 mb-4">Lihat seluruh data laporan masyarakat dan berikan tanggapan langsung.</p>
            <a href="{{ route('petugas.pengaduan.index') }}" class="inline-flex items-center justify-center rounded-lg bg-[#4f46e5] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4338ca] transition-all">
                Buka Daftar Pengaduan
            </a>
        </div>

    </div>
</div>
@endsection