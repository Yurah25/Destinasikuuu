<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $primaryKey = 'id_wisata';
    protected $guarded = [];

    // Relasi ke Kategori (Kebalikan hasMany)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi ke User (Admin yang upload)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Galeri (Satu wisata punya banyak foto)
    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'id_wisata');
    }
}