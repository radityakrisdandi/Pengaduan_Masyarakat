<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pengaduan;
use App\Models\kategori_pengaduan;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori
        $kategori = kategori_pengaduan::all();

        // Query pengaduan
        $query = Pengaduan::with('user', 'kategori');

        // Filter kategori
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Ambil data
        $pengaduan = $query->latest()->get();

        return view('admin.pengaduan.index', compact(
            'pengaduan',
            'kategori'
        ));
    }

    // Tambah kategori
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        kategori_pengaduan::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // Hapus kategori
    public function destroyKategori($id)
    {
        $kategori = kategori_pengaduan::findOrFail($id);

        $kategori->delete();

        return redirect()->back()
            ->with('success', 'Kategori berhasil dihapus');
    }
}