<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    /**
     * Dashboard Ringkasan Petugas
     */
    public function index()
    {
        $totalPengaduan = DB::table('pengaduans')->count();
        $totalPending   = DB::table('pengaduans')->where('status', 'pending')->count();
        $totalProses    = DB::table('pengaduans')->where('status', 'diproses')->count();
        $totalSelesai   = DB::table('pengaduans')->where('status', 'selesai')->count();

        return view('petugas.dashboard', compact('totalPengaduan', 'totalPending', 'totalProses', 'totalSelesai'));
    }

    /**
     * Daftar Semua Pengaduan Masuk (Untuk divalidasi)
     */
    public function pengaduanIndex()
    {
        $listPengaduan = DB::table('pengaduans')
            ->leftJoin('kategori_pengaduans', 'pengaduans.kategori_id', '=', 'kategori_pengaduans.id')
            ->leftJoin('users', 'pengaduans.user_id', '=', 'users.id')
            ->select('pengaduans.*', 'kategori_pengaduans.nama_kategori', 'users.name as nama_pelapor')
            ->orderBy('pengaduans.created_at', 'desc')
            ->get();

        return view('petugas.pengaduan.index', compact('listPengaduan'));
    }

    /**
     * Halaman Detail Pengaduan & Form Pemberian Feedback
     */
    public function pengaduanDetail($id)
    {
        $pengaduan = DB::table('pengaduans')
            ->leftJoin('kategori_pengaduans', 'pengaduans.kategori_id', '=', 'kategori_pengaduans.id')
            ->leftJoin('users', 'pengaduans.user_id', '=', 'users.id')
            ->select('pengaduans.*', 'kategori_pengaduans.nama_kategori', 'users.name as nama_pelapor')
            ->where('pengaduans.id', $id)
            ->first();

        if (!$pengaduan) {
            return redirect()->route('petugas.pengaduan.index')->with('error', 'Data pengaduan tidak ditemukan.');
        }

        // Ambil riwayat tanggapan yang sudah ada untuk pengaduan ini
        $tanggapans = DB::table('tanggapan')
            ->join('users', 'tanggapan.petugas_id', '=', 'users.id')
            ->select('tanggapan.*', 'users.name as nama_petugas')
            ->where('tanggapan.pengaduan_id', $id)
            ->orderBy('tanggapan.created_at', 'asc')
            ->get();

        return view('petugas.pengaduan.detail', compact('pengaduan', 'tanggapans'));
    }

    /**
     * Memproses Pengiriman Feedback / Tanggapan Baru
     */
    public function beriTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|min:5',
            'status' => 'required|in:diproses,selesai'
        ], [
            'isi_tanggapan.required' => 'Feedback wajib diisi.',
            'isi_tanggapan.min' => 'Feedback minimal berisi 5 karakter.'
        ]);

        // 1. Masukkan feedback ke tabel tanggapan sesuai skema database asli kelompokmu
        DB::table('tanggapan')->insert([
            'pengaduan_id'  => $id,
            'petugas_id'    => Auth::id(),
            'isi_tanggapan' => $request->isi_tanggapan,
            'created_at'    => now()
        ]);

        // 2. Update status pengaduan masyarakat di tabel pengaduans
        DB::table('pengaduans')->where('id', $id)->update([
            'status'     => $request->status,
            'updated_at' => now()
        ]);

        return redirect()->route('petugas.pengaduan.detail', $id)->with('success', 'Feedback berhasil dikirim dan status laporan diperbarui.');
    }

    /**
     * Halaman Riwayat Feedback Kerja Petugas + Filter Tanggal
     */
    public function riwayatFeedback(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mengambil data riwayat tanggapan dari seluruh masyarakat yang ditangani petugas
        $query = DB::table('tanggapan')
            ->join('pengaduans', 'tanggapan.pengaduan_id', '=', 'pengaduans.id')
            ->join('users as pelapor', 'pengaduans.user_id', '=', 'pelapor.id')
            ->join('users as petugas', 'tanggapan.petugas_id', '=', 'petugas.id')
            ->select(
                'tanggapan.created_at as tanggal_tanggapan',
                'tanggapan.isi_tanggapan',
                'pengaduans.judul as judul_pengaduan',
                'pengaduans.status',
                'pelapor.name as nama_pelapor',
                'petugas.name as nama_petugas'
            );

        // Penerapan Filter Rentang Tanggal jika diinput oleh petugas
        if ($startDate && $endDate) {
            $query->whereBetween(DB::raw('DATE(tanggapan.created_at)'), [$startDate, $endDate]);
        }

        $riwayat = $query->orderBy('tanggapan.created_at', 'desc')->get();

        return view('petugas.pengaduan.riwayat', compact('riwayat', 'startDate', 'endDate'));
    }
}