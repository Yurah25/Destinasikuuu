@extends('layouts.admin')

@section('content')
    <div class="breadcrumb">
        <i class="fas fa-map-pin"></i> / KELOLA WISATA
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <button onclick="document.getElementById('modalTambah').style.display='flex'" 
                style="background-color: #0d6efd; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 700; cursor: pointer;">
            <i class="fas fa-plus"></i> TAMBAHKAN WISATA
        </button>

        <form action="{{ route('dashboard.wisata') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Masukkan pencarian" value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 5%;">NO</th>
                <th style="width: 20%;">NAMA</th>
                <th style="width: 30%;">DESKRIPSI</th>
                <th style="width: 15%;">HARGA</th>
                <th style="width: 15%;">LOKASI</th>
                <th style="width: 15%;">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wisatas as $index => $w)
            <tr>
                <td><div class="data-box" style="justify-content: center;">{{ $index + 1 }}</div></td>
                <td><div class="data-box">{{ $w->nama_wisata }}</div></td>
                <td><div class="data-box">{{ Str::limit($w->deskripsi, 40) }}</div></td>
                <td><div class="data-box">Rp{{ number_format($w->harga, 0, ',', '.') }}</div></td>
                <td><div class="data-box">Jawa Tengah</div></td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <button style="background: #ffeb3b; border: none; padding: 8px; border-radius: 5px; cursor: pointer;">
                            <i class="fas fa-pencil-alt" style="color: black;"></i>
                        </button>

                        <form action="{{ route('wisata.destroy', $w->id_wisata) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #d32f2f; border: none; padding: 8px; border-radius: 5px; cursor: pointer;">
                                <i class="fas fa-trash" style="color: white;"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada data wisata</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">{{ $wisatas->links() }}</div>

    <div id="modalTambah" style="display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 1000;">
        <div style="background: white; padding: 30px; border-radius: 10px; width: 500px; max-width: 90%;">
            <h2 style="color: #1A3052; margin-bottom: 20px;">Tambah Wisata Baru</h2>
            
            <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 10px;">
                    <label>Nama Wisata</label>
                    <input type="text" name="nama_wisata" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Harga Tiket</label>
                    <input type="number" name="harga" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                </div>
                <div style="margin-bottom: 20px;">
                    <label>Foto Utama</label>
                    <input type="file" name="foto" required style="width: 100%;">
                </div>

                <div style="text-align: right;">
                    <button type="button" onclick="document.getElementById('modalTambah').style.display='none'" style="background: #ccc; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-right: 10px;">Batal</button>
                    <button type="submit" style="background: #1A3052; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection