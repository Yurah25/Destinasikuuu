@extends('layouts.main')

@section('styles')
<style>
    /* --- Layout Container --- */
    .detail-wrapper {
        padding: 40px 8%;
        min-height: 80vh;
        color: #333;
    }

    /* Tombol Kembali */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #1A3052;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 25px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-back:hover { color: #F97316; }

    /* Kotak Putih Utama */
    .content-box {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 50px;
    }

    /* --- Bagian Kiri (Galeri) --- */
    .gallery-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .main-image-frame {
        width: 100%;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #eee;
        background: #f0f0f0; /* Background abu tipis */
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    /* Thumbnail Strip */
    .thumb-strip {
        display: flex;
        gap: 15px;
        position: relative;
        overflow-x: auto; /* Biar bisa scroll kalau gambar banyak */
        padding-bottom: 10px; /* Ruang scrollbar */
    }

    .thumb-box {
        flex: 0 0 100px; /* Ukuran fix agar tidak melar */
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.6;
        transition: 0.3s;
        border: 2px solid transparent;
    }

    .thumb-box.active, .thumb-box:hover {
        opacity: 1;
        border-color: #1A3052;
    }

    .thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* --- Bagian Kanan (Info) --- */
    .info-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .wisata-title {
        font-size: 2rem;
        font-weight: 800;
        color: #000;
        line-height: 1.2;
    }

    .info-section h3 {
        font-size: 1rem;
        color: #333;
        margin-bottom: 5px;
        font-weight: 400;
    }

    .info-text {
        font-size: 0.95rem;
        color: #444;
        line-height: 1.6;
        text-align: justify;
    }

    /* --- SOCIAL BUTTONS --- */
    .action-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-social {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: transform 0.3s, box-shadow 0.3s;
        color: white;
        border: none;
    }

    .btn-social:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .btn-wa { background-color: #25D366; }
    .btn-ig { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }

    /* Responsif Mobile */
    @media (max-width: 900px) {
        .content-box { grid-template-columns: 1fr; gap: 30px; }
        .main-image-frame { height: 300px; }
    }
</style>
@endsection

@section('content')
<div class="detail-wrapper">
    <a href="{{ route('explore') }}" class="btn-back">
        <i class="fas fa-chevron-left"></i> Kembali
    </a>

    <div class="content-box">
        
        <div class="gallery-container">
            <div class="main-image-frame">
                @php
                    $firstGaleri = $wisata->galeris->first();
                    // Jika ada gambar, pakai. Jika tidak, pakai placeholder teks
                    $firstImg = $firstGaleri ? asset('storage/' . $firstGaleri->filename) : 'https://placehold.co/600x400?text=No+Image';
                @endphp
                <img id="mainDisplay" src="{{ $firstImg }}" alt="Main Image" class="main-image">
            </div>

            <div class="thumb-strip">
                @foreach($wisata->galeris as $key => $img)
                    @php $thumbSrc = asset('storage/' . $img->filename); @endphp
                    <div class="thumb-box {{ $key == 0 ? 'active' : '' }}" 
                         onclick="changeImage(this, '{{ $thumbSrc }}')">
                        <img src="{{ $thumbSrc }}" class="thumb-img">
                    </div>
                @endforeach
                
                </div>
        </div>

        <div class="info-container">
            <h1 class="wisata-title">{{ $wisata->nama_wisata }}</h1>

            <div class="info-section">
                <h3>Deskripsi:</h3>
                <p class="info-text">{!! nl2br(e($wisata->deskripsi)) !!}</p>
            </div>

            <div class="info-section">
                <h3>Lokasi:</h3>
                <p class="info-text">Desa Siwarak, Karangreja, Purbalingga, Jawa Tengah</p>
            </div>

            <div class="info-section">
                <h3>Jam Buka:</h3>
                <p class="info-text">Setiap hari 07.00 – 17.00 WIB</p>
            </div>

            <div class="info-section">
                <h3>Harga Tiket:</h3>
                <p class="info-text">Rp{{ number_format($wisata->harga, 0, ',', '.') }} / orang</p>
            </div>

            <div class="info-section">
                <h3>Fasilitas:</h3>
                <p class="info-text">Parkir luas • Mushola • Toilet • Warung • Gazebo • Spot foto</p>
            </div>

            <div class="action-buttons">
                @if($wisata->notelp)
                    @php
                        $noHp = $wisata->notelp;
                        if(Str::startsWith($noHp, '0')){ $noHp = '62' . substr($noHp, 1); }
                    @endphp
                    <a href="https://wa.me/{{ $noHp }}" target="_blank" class="btn-social btn-wa">
                        <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i> Hubungi via WA
                    </a>
                @endif

                @if($wisata->instagram)
                    @php $usernameIg = str_replace('@', '', $wisata->instagram); @endphp
                    <a href="https://instagram.com/{{ $usernameIg }}" target="_blank" class="btn-social btn-ig">
                        <i class="fab fa-instagram" style="font-size: 1.2rem;"></i> Instagram
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changeImage(element, src) {
        document.getElementById('mainDisplay').src = src;
        document.querySelectorAll('.thumb-box').forEach(box => {
            box.classList.remove('active');
        });
        element.classList.add('active');
    }
</script>
@endsection