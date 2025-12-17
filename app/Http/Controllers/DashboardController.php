<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\Galeri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function wisata(Request $request)
    {
        $search = $request->input('search');
        $query = Wisata::with('kategori');

        if($search){
            $query->where('nama_wisata', 'like', "%{$search}%");
        }

        $wisatas = $query->latest()->paginate(10);
        
        return view('admin.wisata.index', compact('wisatas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.wisata.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'fotos' => 'required',
            'fotos.*' => 'image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $wisata = new Wisata();
        $wisata->id_user = Auth::id(); 
        $wisata->id_kategori = $request->id_kategori;
        $wisata->nama_wisata = $request->nama_wisata;
        $wisata->harga = $request->harga;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->instagram = $request->instagram;
        $wisata->notelp = $request->notelp;
        $wisata->save();

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('wisata-images', 'public');
                Galeri::create([
                    'id_wisata' => $wisata->id_wisata,
                    'filename' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.wisata')->with('success', 'Wisata dan Galeri berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $wisata = Wisata::with('galeris')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.wisata.edit', compact('wisata', 'kategoris'));
    }

    // 6. PROSES UPDATE DATA (Support Tambah Foto Baru)
    public function update(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        $request->validate([
            'nama_wisata' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'fotos.*' => 'image|mimes:jpeg,png,jpg|max:2048' // Opsional saat edit
        ]);

        // Update Data Teks
        $wisata->update([
            'id_kategori' => $request->id_kategori,
            'nama_wisata' => $request->nama_wisata,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'instagram' => $request->instagram,
            'notelp' => $request->notelp,
        ]);

        // Jika ada upload foto baru, TAMBAHKAN ke galeri (tidak menimpa yang lama)
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('wisata-images', 'public');
                
                Galeri::create([
                    'id_wisata' => $wisata->id_wisata,
                    'filename' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.wisata')->with('success', 'Data wisata berhasil diperbarui!');
    }

    // 7. PROSES HAPUS WISATA (Full Delete)
    public function destroy($id)
    {
        $wisata = Wisata::with('galeris')->findOrFail($id);
        
        // Hapus semua file gambar fisik terkait wisata ini
        foreach($wisata->galeris as $galeri){
            Storage::disk('public')->delete($galeri->filename);
        }

        // Hapus data dari database (Cascade akan menghapus data di tabel galeris juga)
        $wisata->delete();

        return redirect()->route('dashboard.wisata')->with('success', 'Data wisata berhasil dihapus!');
    }

    // 8. PROSES HAPUS SATU FOTO (Di Halaman Edit)
    public function deleteGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Hapus file fisik
        Storage::disk('public')->delete($galeri->filename);
        
        // Hapus record di database
        $galeri->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}