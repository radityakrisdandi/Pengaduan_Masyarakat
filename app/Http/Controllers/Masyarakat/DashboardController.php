<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import Model
use App\Models\Pengaduan;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Hitung total pengaduan milik user
        $totalPengaduan = Pengaduan::where('user_id', $userId)
                                    ->count();

        // Ambil 5 pengaduan terbaru beserta kategorinya
        $pengaduanTerbaru = Pengaduan::with('kategori')
                                    ->where('user_id', $userId)
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();

        // Ambil semua berita terbaru
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')
                                ->get();

        // Kirim data ke view
        return view('masyarakat.dashboard', compact(
            'totalPengaduan',
            'pengaduanTerbaru',
            'beritaTerbaru'
        ));
    }

    public function berita()
    {
        // Ambil semua berita terbaru
        $semuaBerita = Berita::orderBy('created_at', 'desc')
                            ->get();

        // Tampilkan ke view
        return view('masyarakat.berita.berita', compact('semuaBerita'));
    }
}