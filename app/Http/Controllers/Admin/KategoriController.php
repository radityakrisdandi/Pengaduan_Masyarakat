<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\kategori_pengaduan;

class KategoriController extends Controller
{
    // Halaman kategori
    public function index()
    {
        $kategori = kategori_pengaduan::latest()->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    // Simpan kategori
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        kategori_pengaduan::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()
                ->back()
                ->with('success', 'Kategori berhasil ditambahkan');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = kategori_pengaduan::findOrFail($id);

        $kategori->delete();

        return redirect()
                ->back()
                ->with('success', 'Kategori berhasil dihapus');
    }
}