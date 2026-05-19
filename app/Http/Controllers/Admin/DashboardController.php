<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import Model
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Berita;
class DashboardController extends Controller
{
    public function index()
    {
        // Statistik pengaduan
        $totalPengaduan = Pengaduan::count();

        $pending = Pengaduan::where('status', 'pending')->count();

        $diproses = Pengaduan::where('status', 'diproses')->count();

        $selesai = Pengaduan::where('status', 'selesai')->count();

        // Statistik user
        $totalUser = User::where('role', 'user')->count();

        $totalPetugas = User::where('role', 'petugas')->count();

        // Pengaduan terbaru
        $pengaduanTerbaru = Pengaduan::with('user', 'kategori')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'pending',
            'diproses',
            'selesai',
            'totalUser',
            'totalPetugas',
            'pengaduanTerbaru'
        ));
    }

    public function berita()
    {
        $semuaBerita = Berita::latest()->get();

        return view('admin.berita.index', compact('semuaBerita'));
    }
}
