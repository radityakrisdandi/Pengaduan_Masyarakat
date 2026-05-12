<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'admin_id',
        'judul',
        'isi_berita',
        'gambar'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}