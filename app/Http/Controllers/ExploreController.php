<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;
class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $kategori_id = $request->input('kategori');

        $query = Wisata::with(['galeris', 'kategori']);
        if ($kategori_id) {
            $query->where('id_kategori', $kategori_id);
        }
        $wisatas = $query->latest()->paginate(9);
        $kategoris = Kategori::all();
        return view('explore', compact('wisatas', 'kategoris'));
    }
    public function show($id)
    {
        $wisata = Wisata::with(['galeris', 'kategori'])->findOrFail($id);

        return view('detail', compact('wisata'));
    }
}