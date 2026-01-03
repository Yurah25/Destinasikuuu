<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata; // <--- TAMBAHKAN BARIS INI

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil 3 data terbaru beserta relasi galerinya
        $wisatas = Wisata::with('galeris')->latest()->take(3)->get();
        
        return view('home', compact('wisatas'));
    }
}
