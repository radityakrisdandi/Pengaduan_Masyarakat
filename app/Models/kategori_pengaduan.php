<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori_pengaduan extends Model
{
    protected $table = 'kategori_pengaduan';

    protected $fillable = [
        'nama_kategori'
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}