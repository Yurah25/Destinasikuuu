@extends('layouts.main')

@section('content')
<style>
    
   
    .explore-header {
        text-align: center;
        padding: 40px 20px;
        background: linear-gradient(to bottom, #fffef1, #f0f5e9);
    }

    .explore-header h1 {
        font-size: clamp(24px, 4vw, 36px);
        color: #123714;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .search-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        max-width: 800px;
        margin: 0 auto;
        flex-wrap: wrap;
    }

    .search-input {
        flex: 1; 
        min-width: 200px;
        padding: 12px 20px;
        border-radius: 50px;
        border: 2px solid #5A6C50;
        outline: none;
        font-size: 16px;
        background-color: white;
    }

    .filter-select {
        padding: 12px 20px;
        border-radius: 50px;
        border: 2px solid #5A6C50;
        background-color: white;
        color: #123714;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-search {
        padding: 12px 30px;
        border-radius: 50px;
        background-color: #123714;
        color: white;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-search:hover {
        background-color: #0A400C;
    }

    
    .explore-content {
        padding: 0 clamp(20px, 5vw, 81px); 
        min-height: 60vh;
        margin-bottom: 80px;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin-top: 50px;
        justify-content: center;
    }

    .card {
        width: 100%;
        max-width: 361px;
        margin: 0 auto;
        padding: 24px 30px 40px 30px;
        border-radius: 23.41px;
        border: 1px solid #0A400C;
        background: linear-gradient(to bottom, #D9E9CF 80%, #96A18F 100%);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 1px 2px rgba(0,0,0,0.2);
        margin-bottom: 20px;
    }

    .isi_card {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .isi_card h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
        color: #000;
    }

    .category-badge {
        display: inline-block;
        font-size: 12px;
        color: #123714;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .isi_card p {
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 20px;
        color: #333;
        flex-grow: 1;
        overflow: hidden;
    }

    .detail {
        display: inline-block;
        background-color: #FFF;
        color: #000;
        text-decoration: none;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #5A6C50;
        align-self: flex-start;
        box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .detail:hover {
        background-color: #f0f0f0;
    }

    .pagination-wrapper {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }
    
    @media (max-width: 600px) {
        .search-container {
            flex-direction: column;
        }
        .btn-search {
            width: 100%;
        }
    }
</style>

<div class="explore-header">
    <h1>Temukan Destinasi Impianmu</h1>
    
    <form action="{{ route('explore') }}" method="GET" class="search-container">
        <input type="text" name="search" class="search-input" placeholder="Cari tempat wisata..." value="{{ request('search') }}">
        
        <select name="kategori" class="filter-select">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn-search">Cari</button>
    </form>
</div>

<div class="explore-content">
    <div class="card-grid">
        @forelse($wisatas as $wisata)
            <div class="card">
                @if($wisata->galeris->count() > 0)
                    <img src="{{ asset('storage/' . $wisata->galeris->first()->filename) }}" alt="{{ $wisata->nama_wisata }}">
                @else
                    <img src="https://via.placeholder.com/300?text=No+Image" alt="No Image">
                @endif

                <div class="isi_card">
                    <h3>{{ $wisata->nama_wisata }}</h3>
                    <span class="category-badge">{{ $wisata->kategori->nama_kategori }}</span>
                    <p>{{ Str::limit($wisata->deskripsi, 100) }}</p> <p style="font-weight: bold; color: #123714;">Rp {{ number_format($wisata->harga, 0, ',', '.') }}</p>

                    <a href="#" class="detail">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <h3>Maaf, destinasi tidak ditemukan :(</h3>
                <p>Coba kata kunci lain atau reset filter.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-wrapper">
        {{ $wisatas->withQueryString()->links() }}
    </div>
</div>

@endsection