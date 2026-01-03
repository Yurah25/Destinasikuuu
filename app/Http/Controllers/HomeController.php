<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata; // - Pastikan baris ini ditambahkan

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 data wisata terbaru beserta galerinya
        $wisatas = Wisata::with('galeris')->latest()->take(3)->get();
        
        return view('home', compact('wisatas'));
    }
}