@extends('layout.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('petugas.pengaduan.index') }}" class="text-sm font-medium text-[#4f46e5] hover:text-[#4338ca] flex items-center gap-1">
                ← Kembali ke Daftar Laporan
            </a>

            @if($pengaduan->status == 'pending')
            <form action="{{ route('petugas.tanggapan.store', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin langsung menolak laporan ini?')">
                @csrf
                <input type="hidden" name="status" value="selesai">
                <input type="hidden" name="isi_tanggapan" value="Laporan ditolak oleh petugas karena tidak memenuhi kriteria verifikasi atau indikasi data tidak valid.">
                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-rose-50 border border-rose-200 px-4 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-100 transition-all">
                    ⚠️ Tolak & Selesaikan Cepat
                </button>
            </form>
            @endif
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-sm font-medium text-emerald-800">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6 mb-8">
            <div class="flex items-center justify-between border-b border-[#e2e8f0] pb-4 mb-4">
                <div>
                    <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-800 border border-slate-200 mb-1">
                        {{ $pengaduan->nama_kategori ?? 'Umum' }}
                    </span>
                    <h1 class="text-2xl font-bold text-slate-900">{{ $pengaduan->judul }}</h1>
                </div>
                <div>
                    @if($pengaduan->status == 'pending')
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 ring-1 ring-[#e2e8f0]">Pending</span>
                    @elseif($pengaduan->status == 'diproses')
                        <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-[#e2e8f0]">Diproses</span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-[#e2e8f0]">Selesai</span>
                    @endif
                </div>
            </div>

            <div class="text-sm text-slate-500 mb-4 flex gap-4">
                <p><strong>Pelapor:</strong> {{ $pengaduan->nama_pelapor }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ date('d M Y H:i', strtotime($pengaduan->created_at)) }}</p>
            </div>

            <div class="bg-slate-50 rounded-lg p-4 border border-[#e2e8f0] mb-4">
                <p class="text-sm font-semibold text-slate-900 mb-1">Isi Laporan:</p>
                <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">{{ $pengaduan->deskripsi }}</p>
            </div>

            @if($pengaduan->foto)
            <div>
                <p class="text-sm font-semibold text-slate-900 mb-2">Lampiran Foto Bukti:</p>
                <div class="max-w-md rounded-lg border border-[#e2e8f0] shadow-sm overflow-hidden bg-slate-100 p-2">
                    @php
                        // Membersihkan string jika double prefix folder terbawa dari Controller
                        $cleanPath = $pengaduan->foto;
                        if (\Illuminate\Support\Str::contains($cleanPath, 'public/')) {
                            $cleanPath = str_replace('public/', '', $cleanPath);
                        }
                    @endphp
                    <img src="{{ asset('storage/' . $cleanPath) }}" 
                         class="w-full h-auto rounded-md object-contain max-h-[400px]" 
                         alt="Bukti aduan"
                         onerror="this.onerror=null; this.src='{{ asset('storage/pengaduan/' . $cleanPath) }}';">
                </div>
            </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6 mb-8">
            <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-[#e2e8f0] pb-2">Riwayat Tanggapan Tim</h3>
            <div class="space-y-4">
                @forelse($tanggapans as $tgp)
                <div class="border-l-4 border-[#4f46e5] bg-slate-50/60 p-4 rounded-r-xl border border-y border-r border-[#e2e8f0]">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-bold text-slate-900">{{ $tgp->nama_petugas }} <span class="text-xs font-normal text-slate-400">(Staff)</span></span>
                        <span class="text-xs text-slate-400">{{ date('d M Y H:i', strtotime($tgp->created_at)) }}</span>
                    </div>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $tgp->isi_tanggapan }}</p>
                </div>
                @empty
                <p class="text-sm text-slate-400 text-center py-4">Belum ada tanggapan tertulis yang dirilis untuk aduan ini.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-3">Formulir Respon Tindakan Petugas</h3>
            <form action="{{ route('petugas.tanggapan.store', $pengaduan->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Tulis Tanggapan Resmi :</label>
                    <textarea name="isi_tanggapan" rows="4" class="w-full rounded-xl border border-[#e2e8f0] px-4 py-3 text-sm focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all" placeholder="Ketik tindak lanjut atau jawaban klarifikasi di sini..." required></textarea>
                    @error('isi_tanggapan') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Update Progres Status Aduan :</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer text-sm font-medium text-slate-700">
                            <input type="radio" name="status" value="diproses" {{ $pengaduan->status == 'diproses' ? 'checked' : '' }} class="text-[#4f46e5] focus:ring-[#4f46e5]">
                            Tandai Sedang Diproses
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-sm font-medium text-slate-700">
                            <input type="radio" name="status" value="selesai" {{ $pengaduan->status == 'selesai' ? 'checked' : '' }} class="text-[#4f46e5] focus:ring-[#4f46e5]">
                            Tandai Selesai / Valid
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full rounded-lg bg-[#4f46e5] py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4338ca] transition-all">
                    Kirim & Perbarui Laporan
                </button>
            </form>
        </div>

    </div>
</div>
@endsection