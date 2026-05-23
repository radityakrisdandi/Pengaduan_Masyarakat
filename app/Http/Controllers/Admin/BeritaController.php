<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Halaman kelola berita + Fitur Filter Pencarian
    public function index(Request $request)
    {
        $query = Berita::latest();

        // Cek jika ada input filter pencarian judul atau isi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isi_berita', 'like', "%{$search}%");
            });
        }

        $berita = $query->get();

        return view('admin.berita.index', compact('berita'));
    }

    // Simpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $namaGambar = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([

            'users_id' => auth()->id(),

            'judul' => $request->judul,

            'isi_berita' => $request->isi_berita,

            'gambar' => $namaGambar

        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }

    // Ambil data untuk modal edit (Menghasilkan response JSON)
    public function edit($id)
    {
        // 1. Cari data berita berdasarkan ID
        $berita = Berita::findOrFail($id);

        // 2. KUNCI SUKSESNYA: Kembalikan data dalam bentuk JSON, bukan View!
        return response()->json($berita);
    }

    // Proses Update Berita
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaGambar = $berita->gambar;

        // Jika ada upload gambar baru, hapus gambar lama agar tidak memenuhi server
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $namaGambar = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'isi_berita' => $request->isi_berita,
            'gambar' => $namaGambar,
            'updated_at' => now()
        ]);
    
        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }

    // Hapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file gambar dari storage sebelum datanya dihapus
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
