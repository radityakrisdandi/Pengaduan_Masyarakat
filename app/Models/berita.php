<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Kunci nama tabel sesuai database (tanpa 's')
    protected $table = 'berita'; 

    protected $fillable = [
        'users_id', // diisi dengan id user/petugas yang membuat
        'judul',
        'isi_berita',
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
