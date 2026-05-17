<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    // Menampilkan halaman formulir tambah aduan
    public function create()
    {
        // Ambil data kategori dari tabel kategori_pengaduans untuk isi pilihan (select option)
        $kategori = DB::table('kategori_pengaduans')->get();

        return view('masyarakat.pengaduan.create', compact('kategori'));
    }

    // Menyimpan data aduan ke database
    public function store(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'judul' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048' // Maksimal 2MB
        ]);

        // 2. Proses Upload Foto (Jika ada)
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            // Simpan foto ke folder storage/app/public/pengaduan
            $path = $request->file('foto')->store('pengaduan', 'public');
            $namaFoto = $path;
        }

        // 3. Insert ke Tabel pengaduans sesuai file .sql kamu
        DB::table('pengaduans')->insert([
            'user_id' => Auth::id(), // ID masyarakat yang sedang login
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'status' => 'pending', // Status awal otomatis pending
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Dialihkan ke halaman riwayat pengaduan dengan membawa session alert sukses
        return redirect()->route('pengaduan.riwayat')->with('success', 'Pengaduan Anda berhasil dikirim dan sedang menunggu verifikasi!');
    }

    // 4. Fungsi Menampilkan Riwayat Pengaduan (TAMBAHAN BARU)
    public function riwayat()
    {
        // Ambil ID masyarakat yang aktif login
        $userId = Auth::id();

        // Mengambil semua data pengaduan milik user ini, join dengan tabel kategori
        $laporan = DB::table('pengaduans')
            ->leftJoin('kategori_pengaduans', 'pengaduans.kategori_id', '=', 'kategori_pengaduans.id')
            ->where('pengaduans.user_id', $userId)
            ->select('pengaduans.*', 'kategori_pengaduans.nama_kategori')
            ->orderBy('pengaduans.created_at', 'desc')
            ->get();

        return view('masyarakat.pengaduan.riwayat', compact('laporan'));
    }
}