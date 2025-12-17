<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';

    protected $guarded = [];
    public function wisatas()
    {
        return $this->hasMany(Wisata::class, 'id_kategori');
    }
}