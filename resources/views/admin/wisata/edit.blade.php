@extends('layouts.admin')

@section('content')
<div class="breadcrumb">
    <i class="fas fa-edit"></i> / EDIT WISATA
</div>

<div style="background: white; padding: 30px; border-radius: 10px; max-width: 800px;">
    
    @if ($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Terjadi Kesalahan:</strong>
            <ul style="margin-left: 20px; margin-top: 5px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('wisata.update', $wisata->id_wisata) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama Wisata</label>
            <input type="text" name="nama_wisata" value="{{ old('nama_wisata', $wisata->nama_wisata) }}" class="form-control" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Kategori</label>
            <select name="id_kategori" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
                @foreach($kategoris as $k)
                    <option value="{{ $k->id_kategori }}" {{ $wisata->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Harga Tiket (Rp)</label>
            <input type="number" name="harga" value="{{ old('harga', $wisata->harga) }}" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Deskripsi</label>
            <textarea name="deskripsi" rows="5" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex:1; margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $wisata->instagram) }}" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
            </div>
            <div style="flex:1; margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">No. WhatsApp</label>
                <input type="text" name="notelp" value="{{ old('notelp', $wisata->notelp) }}" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight:bold; margin-bottom:10px;">Galeri Saat Ini</label>
            
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                @forelse($wisata->galeris as $galeri)
                    <div style="position: relative; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                        <img src="{{ asset('storage/' . $galeri->filename) }}" style="width: 100px; height: 70px; object-fit: cover; border-radius: 3px;">
                        
                        <a href="{{ route('galeri.destroy', $galeri->id_galeri) }}" 
                           onclick="event.preventDefault(); if(confirm('Hapus foto ini?')) document.getElementById('del-galeri-{{ $galeri->id_galeri }}').submit();"
                           style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 20px; font-size: 12px; text-decoration: none;">
                           &times;
                        </a>
                    </div>
                    @empty
                    <p style="color: #888; font-size: 0.9rem;">Belum ada foto galeri.</p>
                @endforelse
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Tambah Foto Baru (Bisa Banyak)</label>
            <input type="file" name="fotos[]" multiple class="form-control" style="padding: 10px;">
            <small style="color:#666;">*Biarkan kosong jika tidak ingin menambah foto.</small>
        </div>

        <button type="submit" style="background: #1A3052; color: white; padding: 12px 30px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
            UPDATE DATA
        </button>
        <a href="{{ route('dashboard.wisata') }}" style="margin-left: 10px; color: #555; text-decoration: none;">Batal</a>
    </form>

    @foreach($wisata->galeris as $galeri)
        <form id="del-galeri-{{ $galeri->id_galeri }}" action="{{ route('galeri.destroy', $galeri->id_galeri) }}" method="POST" style="display: none;">
            @csrf @method('DELETE')
        </form>
    @endforeach

</div>
@endsection