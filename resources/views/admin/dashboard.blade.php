@extends('layouts.admin')

@section('content')
    <div class="breadcrumb">
        <i class="fas fa-home"></i> / BERANDA
    </div>

    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <form action="{{ route('dashboard') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Masukkan pencarian" value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 5%;">NO</th>
                <th style="width: 20%;">NAMA</th>
                <th style="width: 35%;">DESKRIPSI</th>
                <th style="width: 15%;">HARGA</th>
                <th style="width: 25%;">LOKASI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wisatas as $index => $w)
            <tr>
                <td><div class="data-box" style="justify-content: center;">{{ $index + 1 }}</div></td>
                <td><div class="data-box">{{ $w->nama_wisata }}</div></td>
                <td><div class="data-box">{{ Str::limit($w->deskripsi, 50) }}</div></td>
                <td><div class="data-box">Rp {{ number_format($w->harga, 0, ',', '.') }}</div></td>
                <td><div class="data-box">Jawa Tengah</div></td> </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px; color: #888;">Data Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $wisatas->links() }}
    </div>
@endsection