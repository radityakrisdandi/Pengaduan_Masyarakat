<?php

namespace Database\Seeders;

use App\Models\kategori_pengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Infrastruktur'],
            ['nama_kategori' => 'Kebersihan'],
            ['nama_kategori' => 'Keamanan'],
            ['nama_kategori' => 'Fasilitas Umum'],
            ['nama_kategori' => 'Lingkungan'],
            ['nama_kategori' => 'Pelayanan Publik'],
            ['nama_kategori' => 'Sosial'],
            ['nama_kategori' => 'Lalu Lintas'],
            ['nama_kategori' => 'Bencana / Darurat'],
            ['nama_kategori' => 'Lainnya'],
        ];

        foreach ($kategori as $item) {
            kategori_pengaduan::create($item);
        }
    }
}