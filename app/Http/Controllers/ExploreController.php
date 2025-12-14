<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori_id = $request->input('kategori');

        
        $query = Wisata::query();


        if ($search) {
            $query->where('nama_wisata', 'like', "%{$search}%");
        }

        if ($kategori_id) {
            $query->where('id_kategori', $kategori_id);
        }
        $wisatas = $query->paginate(9);
        $kategoris = Kategori::all();

        return view('explore', compact('wisatas', 'kategoris'));
    }
}