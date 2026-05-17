@extends('layout.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 border-b border-[#e2e8f0] pb-5">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Riwayat Penanganan Feedback</h1>
            <p class="mt-2 text-sm text-slate-500">Log arsip penyelesaian pengaduan masyarakat oleh seluruh tim petugas lapangan.</p>
        </div>

        <div class="bg-white rounded-xl border border-[#e2e8f0] p-4 shadow-sm mb-6">
            <form method="GET" action="{{ route('petugas.riwayat.index') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-auto">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Dari Tanggal :</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="w-full rounded-lg border border-[#e2e8f0] px-3 py-2 text-sm focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5]">
                </div>
                <div class="w-full md:w-auto">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Sampai Tanggal :</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="w-full rounded-lg border border-[#e2e8f0] px-3 py-2 text-sm focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5]">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="bg-[#4f46e5] hover:bg-[#4338ca] text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-all w-full md:w-auto">
                        Filter Data
                    </button>
                    @if($startDate || $endDate)
                        <a href="{{ route('petugas.riwayat.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold px-4 py-2 rounded-lg text-center transition-all w-full md:w-auto">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#e2e8f0] text-left">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Respon</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Masyarakat (Pelapor)</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Judul Aduan</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Isi Feedback Petugas</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e2e8f0] bg-white text-sm text-slate-700">
                        @forelse($riwayat as $log)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                {{ date('d M Y H:i', strtotime($log->tanggal_tanggapan)) }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900">
                                {{ $log->nama_pelapor }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800 max-w-xs truncate">
                                {{ $log->judul_pengaduan }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-sm truncate">
                                {{ $log->isi_tanggapan }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if($log->status == 'diproses')
                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Diproses</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-700/10">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                Belum ada riwayat feedback yang terekam pada rentang tanggal ini.
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