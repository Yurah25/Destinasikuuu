<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $primaryKey = 'id_galeri';
    protected $guarded = [];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_wisata');
    }
}