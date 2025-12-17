@extends('layouts.main')

@section('styles')
<style>
    .explore-container {
        padding: 40px 8%;
        min-height: 80vh;
        background-color: var(--primary-beige); /* Pastikan background halaman cream */
    }

    /* --- FILTER BUTTONS (DIPERBAIKI) --- */
    .filter-section {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 50px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 12px 35px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        /* Menggunakan warna PUTIH agar tidak nyatu dengan background cream */
        background-color: #ffffff; 
        color: #555;
        border: 2px solid transparent; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.05); /* Efek timbul */
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none; /* Hapus garis bawah link */
        display: inline-block;
    }

    .filter-btn:hover {
        background-color: #f0f0f0;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        color: #333;
    }

    /* Tombol Aktif (Biru Navy Gelap) */
    .filter-btn.active {
        background-color: #1A3052; 
        color: white;
        box-shadow: 0 5px 15px rgba(26, 48, 82, 0.3);
    }

    /* --- CARD GRID --- */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    /* Link pembungkus card */
    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .card {
        background-color: var(--primary-dark); /* Biru Navy dari variable layout */
        /* Atau hardcode: background-color: #1A3052; */
        border-radius: 20px;
        overflow: hidden;
        color: white;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
        position: relative;
        height: 100%;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    /* --- IMAGE SECTION --- */
    .card-img-container {
        height: 200px;
        width: 100%;
        position: relative;
        background-color: #ddd;
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: white;
        color: #333;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    /* --- CONTENT SECTION --- */
    .card-body {
        padding: 25px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex-grow: 1;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: white;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.85rem;
        line-height: 1.5;
        color: #e0e0e0;
    }

    .info-row i {
        margin-top: 3px;
        width: 15px;
        text-align: center;
    }

    .info-label {
        font-weight: 600;
        color: white;
        min-width: 70px;
    }

    .pagination-container {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }
</style>
@endsection

@section('content')
<div class="explore-container">
    
    <div class="filter-section">
        <a href="{{ route('explore') }}" 
           class="filter-btn {{ !request('kategori') ? 'active' : '' }}">
           All
        </a>

        @foreach($kategoris as $kategori)
            <a href="{{ route('explore', ['kategori' => $kategori->id_kategori]) }}" 
               class="filter-btn {{ request('kategori') == $kategori->id_kategori ? 'active' : '' }}">
               {{ $kategori->nama_kategori }}
            </a>
        @endforeach
    </div>

    <div class="card-grid">
        @forelse($wisatas as $wisata)
            <a href="{{ route('explore.show', $wisata->id_wisata) }}" class="card-link">
                <div class="card">
                    <div class="card-img-container">
                        @php
                            $galeri = $wisata->galeris->first();
                            $imgSrc = $galeri ? asset('storage/' . $galeri->filename) : 'https://placehold.co/600x400?text=No+Image';
                        @endphp
                        <img src="{{ $imgSrc }}" 
                             alt="{{ $wisata->nama_wisata }}" 
                             class="card-img"
                             onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=Image+Not+Found';">
                        
                        <span class="category-badge">
                            {{ $wisata->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <div class="card-body">
                        <h3 class="card-title">{{ $wisata->nama_wisata }}</h3>

                        <div class="info-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                <span class="info-label">Lokasi</span> : 
                                {{ $wisata->lokasi ?? 'Kec. Baturraden, Banyumas' }}
                            </span>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-ticket-alt"></i>
                            <span>
                                <span class="info-label">Harga Tiket</span> : 
                                Rp{{ number_format($wisata->harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="info-row">
                            <i class="far fa-clock"></i>
                            <span>
                                <span class="info-label">Jam Buka</span> : 
                                08.00 - 17.00 WIB
                            </span>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-pencil-alt"></i>
                            <span>
                                <span class="info-label">Deskripsi</span> : 
                                {{ Str::limit($wisata->deskripsi, 80, '...') }}
                            </span>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-city"></i>
                            <span>
                                <span class="info-label">Fasilitas</span> : 
                                Parkir, Warung, Toilet, Mushola
                            </span>
                        </div>
                    </div> </div> </a> @empty
            <div style="grid-column: 1/-1; text-align: center; color: #666; margin-top: 50px;">
                <h3>Belum ada data wisata untuk kategori ini.</h3>
            </div>
        @endforelse
    </div>

    <div class="pagination-container">
        {{ $wisatas->appends(request()->query())->links() }}
    </div>
</div>
@endsection