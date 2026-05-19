<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Halaman berita
    public function index()
    {
        $berita = Berita::latest()->get();

        return view('petugas.berita.index', compact('berita'));
    }

    // Simpan berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi_berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload gambar
        $namaGambar = null;

        if ($request->hasFile('gambar')) {

            $namaGambar = $request->file('gambar')
                ->store('berita', 'public');
        }

        Berita::create([
            'petugas_id' => auth()->id(),

            'judul' => $request->judul,

            'isi_berita' => $request->isi_berita,

            'gambar' => $namaGambar
        ]);

        return redirect()
            ->back()
            ->with('success', 'Berita berhasil ditambahkan');
    }

    // Hapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->delete();

        return redirect()
            ->back()
            ->with('success', 'Berita berhasil dihapus');
    }
}
