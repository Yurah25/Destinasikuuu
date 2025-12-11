<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Beri tahu Laravel primary key kita custom
    protected $primaryKey = 'id_kategori';
    
    // Izinkan semua kolom diisi
    protected $guarded = [];

    // Relasi: Satu kategori punya banyak wisata
    public function wisatas()
    {
        return $this->hasMany(Wisata::class, 'id_kategori');
    }
}