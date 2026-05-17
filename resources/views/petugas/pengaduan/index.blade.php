@extends('layout.app') {{-- Sesuaikan nama master layout kelompokmu jika berbeda --}}

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between border-b border-[#e2e8f0] pb-5">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Daftar Pengaduan Masuk</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola, validasi, dan berikan tanggapan resmi pada laporan dari masyarakat secara real-time.</p>
            </div>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-sm font-medium text-rose-800">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#e2e8f0] text-left">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Pelapor</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Judul Laporan</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Kategori</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Masuk</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e2e8f0] bg-white text-sm text-slate-700">
                        @forelse($listPengaduan as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">
                                {{ $item->nama_pelapor ?? 'Masyarakat' }}
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate font-medium text-slate-800">
                                {{ $item->judul }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-800 border border-slate-200">
                                    {{ $item->nama_kategori ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                {{ date('d M Y', strtotime($item->created_at)) }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if($item->status == 'pending')
                                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                                @elseif($item->status == 'diproses')
                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 ring-1 ring-inset ring-blue-600/20">Diproses</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Selesai</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('petugas.pengaduan.detail', $item->id) }}" class="inline-flex items-center justify-center rounded-lg bg-[#4f46e5] px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-[#4338ca] transition-all focus:outline-none">
                                    Tinjau Laporan
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <span class="text-base font-medium">Belum ada pengaduan masuk</span>
                                    <p class="text-xs text-slate-400">Semua laporan pengaduan masyarakat akan tampil otomatis di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection