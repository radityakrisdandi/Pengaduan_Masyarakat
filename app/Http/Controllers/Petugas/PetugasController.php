<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktivitas;
class PetugasController extends Controller
{
    /**
     * Dashboard Ringkasan Petugas
     */
    public function index()
    {
        // REVISI LOGIKA:
        // 1. Total Pengaduan menghitung semua data KECUALI yang masih pending tapi sudah dihapus/dibatalkan oleh user.
        $totalPengaduan = DB::table('pengaduans')
            ->whereNot(function ($query) {
                $query->where('status', 'pending')->whereNotNull('deleted_at');
            })->count();

        // 2. Total Pending hanya menghitung yang belum dihapus (deleted_at IS NULL)
        $totalPending = DB::table('pengaduans')
            ->where('status', 'pending')
            ->whereNull('deleted_at')
            ->count();

        // 3. Total Proses & Selesai tetap menampilkan data meskipun user mencoba menghapusnya (sebagai arsip staff)
        $totalProses = DB::table('pengaduans')->where('status', 'diproses')->count();
        $totalSelesai = DB::table('pengaduans')->where('status', 'selesai')->count();

        return view('petugas.dashboard', compact('totalPengaduan', 'totalPending', 'totalProses', 'totalSelesai'));
    }

    /**
     * Daftar Semua Pengaduan Masuk (Untuk divalidasi)
     */
    public function pengaduanIndex()
    {
        // REVISI LOGIKA: 
        // Menggunakan Filter khusus. Jika status 'pending' DAN 'deleted_at' tidak null (artinya dihapus saat belum diproses),
        // maka pengaduan tersebut akan DISINGKIRKAN dan tidak ditampilkan di tabel staff.
        $listPengaduan = DB::table('pengaduans')
            ->leftJoin('kategori_pengaduans', 'pengaduans.kategori_id', '=', 'kategori_pengaduans.id')
            ->leftJoin('users', 'pengaduans.user_id', '=', 'users.id')
            ->select('pengaduans.*', 'kategori_pengaduans.nama_kategori', 'users.name as nama_pelapor')
            ->whereNot(function ($query) {
                $query->where('pengaduans.status', 'pending')
                    ->whereNotNull('pengaduans.deleted_at');
            })
            ->orderBy('pengaduans.created_at', 'desc')
            ->get();

        return view('petugas.pengaduan.index', compact('listPengaduan'));
    }

    /**
     * Halaman Detail Pengaduan & Form Pemberian Feedback
     */
    public function pengaduanDetail($id)
    {
        // REVISI LOGIKA:
        // Staff tidak boleh membuka detail pengaduan yang tipenya masih pending tapi sudah dihapus/dibatalkan oleh user.
        $pengaduan = DB::table('pengaduans')
            ->leftJoin('kategori_pengaduans', 'pengaduans.kategori_id', '=', 'kategori_pengaduans.id')
            ->leftJoin('users', 'pengaduans.user_id', '=', 'users.id')
            ->select('pengaduans.*', 'kategori_pengaduans.nama_kategori', 'users.name as nama_pelapor')
            ->where('pengaduans.id', $id)
            ->whereNot(function ($query) {
                $query->where('pengaduans.status', 'pending')
                    ->whereNotNull('pengaduans.deleted_at');
            })
            ->first();

        if (!$pengaduan) {
            return redirect()->route('petugas.pengaduan.index')->with('error', 'Data pengaduan tidak ditemukan atau telah dibatalkan oleh pelapor.');
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

        // 1. Masukkan feedback ke tabel tanggapan
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
        LogAktivitas::create([

            'user_id' => auth()->id(),

            'aktivitas' => 'Petugas menanggapi pengaduan'

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

        // Mengambil data riwayat tanggapan
        $query = DB::table('tanggapan')
            ->join('pengaduans', 'tanggapan.pengaduan_id', '=', 'pengaduans.id')
            ->join('users as pelapor', 'pengaduans.user_id', '=', 'pelapor.id')
            ->join('users as petugas', 'tanggapan.petugas_id', '=', 'petugas.id')
            ->select(
                'tanggapan.created_at as tanggal_tanggapan',
                'tanggapan.isi_tanggapan',
                'pengaduans.judul as judul_pengaduan',
                'pengaduans.status',
                'pengaduans.deleted_at',
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
