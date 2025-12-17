@extends('layouts.admin')

@section('content')
<div class="breadcrumb">
    <i class="fas fa-map-pin"></i> / KELOLA WISATA
</div>

<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <a href="{{ route('wisata.create') }}" 
       style="background: #1A3052; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
       + TAMBAH WISATA
    </a>
</div>

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

<table class="admin-table">
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA WISATA</th>
            <th>KATEGORI</th>
            <th>HARGA</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
        @forelse($wisatas as $key => $w)
        <tr>
            <td><div class="data-box" style="justify-content: center;">{{ $wisatas->firstItem() + $key }}</div></td>
            <td><div class="data-box">{{ $w->nama_wisata }}</div></td>
            <td><div class="data-box">{{ $w->kategori->nama_kategori ?? '-' }}</div></td>
            <td><div class="data-box">Rp {{ number_format($w->harga, 0, ',', '.') }}</div></td>
            <td>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('wisata.edit', $w->id_wisata) }}" 
                       style="background: #ffc107; padding: 8px 12px; border-radius: 5px; color: black;">
                       <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form action="{{ route('wisata.destroy', $w->id_wisata) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: #dc3545; border: none; padding: 8px 12px; border-radius: 5px; color: white; cursor: pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center; padding: 20px;">Data Kosong</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $wisatas->links() }}
@endsection