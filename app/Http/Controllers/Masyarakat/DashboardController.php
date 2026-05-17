<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil ID user yang sedang login saat ini
        $userId = Auth::id();

        // 2. Hitung total pengaduan khusus milik user yang sedang login
        $totalPengaduan = DB::table('pengaduans')
                            ->where('user_id', $userId)
                            ->count();

        // 3. Ambil 5 pengaduan terbaru milik user tersebut
        $pengaduanTerbaru = DB::table('pengaduans')
                            ->leftJoin('kategori_pengaduans', 'pengaduans.kategori_id', '=', 'kategori_pengaduans.id')
                            ->where('pengaduans.user_id', $userId)
                            ->select('pengaduans.*', 'kategori_pengaduans.nama_kategori')
                            ->orderBy('pengaduans.created_at', 'desc')
                            ->take(5)
                            ->get();

        // 4. Ambil semua berita terbaru untuk ditampilkan di grid utama dashboard
        $beritaTerbaru = DB::table('berita')
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Kirim semua data ke view dashboard masyarakat
        return view('masyarakat.dashboard', compact('totalPengaduan', 'pengaduanTerbaru', 'beritaTerbaru'));
    }

    // REVISI: Jalur view disesuaikan dengan folder "berita" yang kamu buat
    public function berita()
    {
        // Ambil semua data dari tabel berita
        $semuaBerita = DB::table('berita')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Mengarah ke folder: views/masyarakat/berita/berita.blade.php
        return view('masyarakat.berita.berita', compact('semuaBerita'));
    }
}