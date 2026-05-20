<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    // REVISI UTAMA: Mengunci nama tabel agar tidak otomatis dibaca 'tanggapans' oleh Laravel
    protected $table = 'tanggapan'; 

    protected $guarded = [];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }
}