<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Pengaduan extends Model
{
    use SoftDeletes; 

    protected $table = 'pengaduans';

    // Di Laravel terbaru, gunakan $casts untuk deleted_at, bukan $dates lagi
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * REVISI: Menggunakan huruf kecil 'kategori_pengaduan' 
     * Sesuai dengan deklarasi nama class asli pada file kategori_pengaduan.php Anda
     */
    public function kategori()
    {
        return $this->belongsTo(kategori_pengaduan::class, 'kategori_id');
    }

    /**
     * REVISI: Menggunakan huruf kecil 'tanggapan' 
     * Menyesuaikan format model tanggapan Anda agar seragam dan aman dari error Case-Sensitive
     */
    public function tanggapan()
    {
        return $this->hasMany(tanggapan::class, 'pengaduan_id');
    }
}