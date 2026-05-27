<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\LogAktivitas;
use App\Models\Pengaduan;
use App\Models\kategori_pengaduan;

class PengaduanController extends Controller
{
    // Menampilkan halaman form tambah pengaduan
    public function create()
    {
        // Ambil semua kategori
        $kategori = kategori_pengaduan::all();

        return view('masyarakat.pengaduan.create', compact('kategori'));
    }

    // Menyimpan pengaduan
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'judul' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Upload foto jika ada
        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $namaFoto = $request->file('foto')
                ->store('pengaduan', 'public');
        }

        // Simpan ke database
        Pengaduan::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'status' => 'pending',

        ]);
        LogAktivitas::create([

            'user_id' => auth()->id(),

            'aktivitas' => 'Membuat pengaduan baru'

        ]);
        return redirect()
            ->route('pengaduan.riwayat')
            ->with(
                'success',
                'Pengaduan Anda berhasil dikirim dan sedang menunggu verifikasi!'
            );
    }

    // Menampilkan riwayat pengaduan user

    public function riwayat()
    {
        // Ambil data laporan milik user yang login tanpa eager loading tanggapan agar anti-crash
        $laporan = Pengaduan::with(['kategori'])
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->get();

        return view('masyarakat.pengaduan.riwayat', compact('laporan'));
    }

    // Halaman edit
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $kategori = kategori_pengaduan::all();

        return view('masyarakat.pengaduan.edit', compact('pengaduan', 'kategori'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $namaFoto = $pengaduan->foto;

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($pengaduan->foto) {
                Storage::disk('public')->delete($pengaduan->foto);
            }

            $namaFoto = $request->file('foto')
                ->store('pengaduan', 'public');
        }

        // Update data
        $pengaduan->update([

            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,

        ]);

        // LOG AKTIVITAS
        LogAktivitas::create([

            'user_id' => auth()->id(),

            'aktivitas' => 'Mengedit pengaduan'

        ]);

        return redirect()
            ->route('pengaduan.riwayat')
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Hapus foto jika ada
        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        // Hapus data
        $pengaduan->delete();
        LogAktivitas::create([

            'user_id' => auth()->id(),

            'aktivitas' => 'Menghapus pengaduan'

        ]);
        return redirect()
            ->route('pengaduan.riwayat')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
