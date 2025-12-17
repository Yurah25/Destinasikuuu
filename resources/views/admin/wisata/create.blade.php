@extends('layouts.admin')

@section('content')
<div class="breadcrumb">
    <i class="fas fa-plus-circle"></i> / TAMBAH WISATA
</div>

<div style="background: white; padding: 30px; border-radius: 10px; max-width: 800px;">
    <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama Wisata</label>
            <input type="text" name="nama_wisata" class="form-control" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Kategori</label>
            <select name="id_kategori" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
                @foreach($kategoris as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Harga Tiket (Rp)</label>
            <input type="number" name="harga" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Deskripsi & Info Lokasi</label>
            <textarea name="deskripsi" rows="5" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required></textarea>
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex:1; margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Instagram (Opsional)</label>
                <input type="text" name="instagram" placeholder="@username" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
            </div>
            <div style="flex:1; margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">No. WhatsApp (Opsional)</label>
                <input type="text" name="notelp" placeholder="08xxxx" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Upload Galeri Foto (Bisa Banyak)</label>
            
            <input type="file" name="fotos[]" multiple class="form-control" style="padding: 10px;" required>
            
            <small style="color:#666; display:block; margin-top:5px;">
                *Tahan tombol <b>CTRL</b> saat memilih file untuk upload lebih dari satu gambar sekaligus.
            </small>
        </div>

        <button type="submit" style="background: #1A3052; color: white; padding: 12px 30px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
            SIMPAN DATA
        </button>
        <a href="{{ route('dashboard.wisata') }}" style="margin-left: 10px; color: #555; text-decoration: none;">Batal</a>
    </form>
</div>
@endsection