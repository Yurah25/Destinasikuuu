@extends('layouts.main')

@section('styles')
<style>
    .hero {
        position: relative;
        top: 0;
        height: 100vh;
        height: 100dvh; 
        width: 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .slider-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        background-size: cover;
        background-position: center;
    }

    .slide.active {
        opacity: 1;
    }

    /* Overlay Gelap di atas gambar agar tulisan terbaca */
    .slide::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

    /* Blur Gradient di Bawah Hero (Requirement Anda) */
    .hero-bottom-fade {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 150px;
        background: linear-gradient(to top, var(--primary-beige), transparent);
        z-index: 5;
        pointer-events: none; /* Agar klik tembus */
    }

    /* Konten Teks Hero */
    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 800px;
        padding: 0 20px;
    }

    .hero-content h3 { font-size: 1.2rem; margin-bottom: 10px; font-weight: 400; letter-spacing: 1px; }
    .hero-content h1 { font-size: 3.5rem; font-weight: 800; margin-bottom: 30px; text-transform: uppercase; }
    .btn-hero {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid white;
        padding: 12px 30px;
        color: white;
        border-radius: 30px;
        font-weight: 600;
        backdrop-filter: blur(5px);
        transition: 0.3s;
        cursor: pointer;
    }
    .btn-hero:hover { background: white; color: black; }

    /* Navigasi Slider (Panah) */
    .prev, .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        color: #ffffff3a;
        border: none;
        padding: 15px;
        cursor: pointer;
        z-index: 20;
        border-radius: 50%;
        font-size: 1.2rem;
        transition: 0.3s;
    }
    .prev:hover, .next:hover { background: rgba(255,255,255,0.3); }
    .prev { left: 20px; }
    .next { right: 20px; }

    /* Navigasi Dots (Titik-titik) */
    .dots-container {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 20;
    }

    .dot {
        width: 12px;
        height: 12px;
        background: rgba(255,255,255,0.5);
        border-radius: 50%;
        cursor: pointer;
        transition: 0.3s;
    }
    .dot.active { background: white; transform: scale(1.2); }

    /* --- SECTION SHARED STYLES --- */
    .section-padding { padding: 80px 10%; }
    .section-title { text-align: center; margin-bottom: 40px; color: var(--primary-dark); font-size: 2.5rem; font-weight: 800; }
    .section-subtitle { text-align: center; margin-top: -30px; margin-bottom: 50px; color: #666; font-size: 0.9rem; }

    /* --- SECTION: WHAT? --- */
    .what-section { background-color: var(--primary-beige); }
    .dark-card {
        background-color: var(--primary-dark);
        color: white;
        padding: 50px;
        border-radius: 30px;
        text-align: left;
    }
    .dark-card h2 { margin-bottom: 20px; font-size: 2rem; }
    .dark-card p { line-height: 1.8; margin-bottom: 20px; color: #ddd; }
    .read-more { color: #aaa; font-weight: 600; font-size: 0.9rem; }

    /* --- SECTION: LET'S EXPLORE --- */
    .explore-section { background-color: var(--primary-dark); color: white; }
    .explore-section .section-title { color: white; }
    .explore-section .section-subtitle { color: #ccc; }
    
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .card-item {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        color: var(--primary-dark);
        text-align: left;
        padding-bottom: 20px;
    }
    
    .card-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .card-body { padding: 20px; }
    .card-body h3 { font-size: 1.2rem; margin-bottom: 5px; font-weight: 800; }
    .card-body .price { font-size: 0.8rem; font-weight: 600; margin-bottom: 10px; display: block; }
    .card-body p { font-size: 0.85rem; line-height: 1.5; color: #555; margin-bottom: 20px; }
    
    .btn-detail {
        display: block;
        width: 100%;
        text-align: center;
        background: var(--primary-dark);
        color: white;
        padding: 10px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* --- SECTION: WHY? --- */
    .why-section { background-color: var(--primary-beige); }
    .why-container {
        background-color: var(--primary-dark);
        border-radius: 30px;
        padding: 50px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .why-card {
        background: white;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
    }

    .why-card h3 { color: var(--primary-dark); margin-bottom: 15px; font-weight: 800; text-transform: uppercase; }
    .why-card p { font-size: 0.85rem; color: #555; line-height: 1.6; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .why-container { grid-template-columns: 1fr; }
        .hero-content h1 { font-size: 2rem; }
    }
</style>
@endsection

@section('content')

<section class="hero">
    <div class="slider-container">
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073&auto=format&fit=crop');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=2070&auto=format&fit=crop');"></div>
    </div>

    <div class="hero-content">
        <h3>Selamat datang di website resmi "Destinasiku"</h3>
        <h1>YUK EKSPLORASI BERSAMA!</h1>
        <button class="btn-hero" onclick="document.getElementById('explore').scrollIntoView()">SELENGKAPNYA</button>
    </div>

    <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
    <button class="next" onclick="moveSlide(1)">&#10095;</button>

    <div class="dots-container">
        <span class="dot active" onclick="currentSlide(0)"></span>
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
    </div>

    <div class="hero-bottom-fade"></div>
</section>

<section class="what-section section-padding">
    <h2 class="section-title">What?</h2>
    <div class="dark-card">
        <p>Destinasiku merupakan platform yang dikembangkan oleh kelompok 6 dalam rangka memenuhi tugas besar mata kuliah Analisis Desain dan Sistem dan Pemrograman Web (A). Platform ini dirancang untuk membantu calon wisatawan maupun wisatawan dalam menemukan informasi destinasi secara cepat, mudah, dan akurat.</p>
        <p>Melalui Destinasiku, kami ingin menghadirkan pengalaman wisata yang lebih terarah, informatif, dan user-friendly. Fokus pengembangan kami saat ini adalah pada berbagai destinasi wisata di wilayah Banyumas, Purbalingga, Kebumen, dan sekitarnya, yang dikenal memiliki keragaman budaya, kuliner, serta keindahan alam yang layak untuk dieksplorasi.</p>
        <a href="#" class="read-more">Baca Selengkapnya...</a>
    </div>
</section>

<section class="explore-section section-padding" id="explore">
    <h2 class="section-title">Let's Explore</h2>
    <p class="section-subtitle">Mari Lihat Keragaman Banyumas dan Sekitarnya di bawah ini!</p>
    
    <div class="card-grid">
        <div class="card-item">
            <img src="https://images.unsplash.com/photo-1519046904884-53103b34b271?q=80&w=2070&auto=format&fit=crop" class="card-img" alt="Pantai">
            <div class="card-body">
                <h3>Pantai Menganti</h3>
                <span class="price">HTM: Rp20.000,00</span>
                <p>Pantai Menganti merupakan sebuah pantai yang berlokasi di Desa Karangduwur, Kecamatan Ayah, Kabupaten Kebumen. Jawa Tengah.</p>
                <a href="#" class="btn-detail">Informasi Lebih Lanjut</a>
            </div>
        </div>

        <div class="card-item">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=2070&auto=format&fit=crop" class="card-img" alt="Gunung">
            <div class="card-body">
                <h3>Gunung Slamet</h3>
                <span class="price">HTM: Rp25.000,00</span>
                <p>Gunung Slamet adalah sebuah gunung berapi kerucut tipe A yang berada di Jawa Tengah, Indonesia, dan merupakan gunung tertinggi.</p>
                <a href="#" class="btn-detail">Informasi Lebih Lanjut</a>
            </div>
        </div>

        <div class="card-item">
            <img src="https://images.unsplash.com/photo-1580495326876-0c68102d9061?q=80&w=2070&auto=format&fit=crop" class="card-img" alt="Museum">
            <div class="card-body">
                <h3>Museum Jenderal Soedirman</h3>
                <span class="price">HTM: Rp5.000,00</span>
                <p>Museum Panglima Besar Jenderal Soedirman atau yang biasa disebut Museum Pangsar Soedirman terletak di pinggiran kota Purwokerto.</p>
                <a href="#" class="btn-detail">Informasi Lebih Lanjut</a>
            </div>
        </div>
    </div>
</section>

<section class="why-section section-padding">
    <h2 class="section-title">Why?</h2>
    
    <div class="why-container">
        <div class="why-card">
            <h3>USER FRIENDLY</h3>
            <p>Website didesain agar mudah diakses, struktur menu yang jelas, memudahkan pengguna dalam mencari informasi yang dibutuhkan tanpa kebingungan.</p>
        </div>
        <div class="why-card">
            <h3>INFORMASI LENGKAP</h3>
            <p>Wisata menyediakan data yang detail dan relevan sesuai kebutuhan pengguna. Semua informasi penting tersaji secara akurat.</p>
        </div>
        <div class="why-card">
            <h3>RESPONSIF</h3>
            <p>Website bekerja dengan baik di berbagai perangkat, baik itu smartphone, tablet, maupun laptop. Tampilan menyesuaikan ukuran layar.</p>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    /* --- LOGIKA SLIDER (Carousel) --- */
    let slideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = slides.length;
    let autoSlideInterval;

    // Fungsi untuk menampilkan slide tertentu
    function showSlide(n) {
        // Reset index jika melebihi batas
        if (n >= totalSlides) slideIndex = 0;
        if (n < 0) slideIndex = totalSlides - 1;

        // Hilangkan class active dari semua slide dan dot
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Tambahkan class active ke slide dan dot yang sekarang
        slides[slideIndex].classList.add('active');
        dots[slideIndex].classList.add('active');
    }

    // Fungsi untuk tombol Next/Prev
    function moveSlide(n) {
        slideIndex += n;
        showSlide(slideIndex);
        resetAutoSlide(); // Reset timer agar tidak bentrok
    }

    // Fungsi untuk tombol Dots
    function currentSlide(n) {
        slideIndex = n;
        showSlide(slideIndex);
        resetAutoSlide();
    }

    // Fungsi Auto Slide
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            slideIndex++;
            showSlide(slideIndex);
        }, 5000); // Ganti setiap 5 detik
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Jalankan pertama kali
    document.addEventListener("DOMContentLoaded", () => {
        showSlide(slideIndex);
        startAutoSlide();
    });
</script>
@endsection