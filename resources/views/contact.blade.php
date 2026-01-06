@extends('layouts.main')

@section('styles')
<style>
    /* --- HERO SECTION --- */
    .hero-contact {
        position: relative;
        height: 60vh; /* Tinggi hero */
        width: 100%;
        /* Gambar pantai mirip referensi */
        background: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2071&auto=format&fit=crop') no-repeat center center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    /* Overlay gelap tipis agar teks terbaca */
    .hero-contact::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.2); 
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Efek Blur/Fade di bawah hero (Sesuai style website Anda) */
    .hero-bottom-fade {
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 100px;
        background: linear-gradient(to top, var(--primary-beige), transparent);
        z-index: 5;
    }

    /* --- CONTENT WRAPPER --- */
    .contact-container {
        padding: 40px 10%;
        background-color: var(--primary-beige);
        text-align: center;
    }

    /* --- FORMULIR ADUAN --- */
    .form-section-title {
        color: #1A3052;
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .form-card {
        background-color: #E6E6E6; /* Abu-abu sesuai gambar */
        padding: 40px;
        border-radius: 30px;
        max-width: 800px;
        margin: 0 auto 60px; /* Center & Margin bawah */
        text-align: left;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 800;
        color: #1A3052;
        margin-bottom: 8px;
        font-size: 1.1rem;
        text-transform: uppercase;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border-radius: 10px;
        border: none;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
    }

    textarea.form-control {
        height: 150px;
        resize: vertical;
    }

    .btn-submit {
        background-color: #1A3052; /* Navy */
        color: white;
        padding: 12px 40px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-submit:hover {
        background-color: #0f1c30;
    }

    /* --- KONTAK KAMI SECTION --- */
    .contact-section-title {
        color: #1A3052;
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 30px;
        text-decoration: underline;
        text-underline-offset: 10px;
    }

    .contact-box {
        background-color: #1A3052; /* Navy Background */
        border-radius: 30px;
        padding: 50px 20px;
        color: white;
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 Kolom */
        gap: 20px;
        align-items: start;
    }

    .contact-column {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .contact-icon-circle {
        /* Icon besar di atas */
        font-size: 3.5rem; 
        margin-bottom: 10px;
    }
    
    .fa-whatsapp { color: #25D366; }
    .fa-instagram { 
        background: -webkit-linear-gradient(#f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    }
    .fa-github { color: white; }

    /* Kotak Putih Nama & Nomor */
    .info-card {
        background-color: #FDF6E3; /* Warna cream keputihan */
        color: #1A3052;
        width: 100%;
        max-width: 280px;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 10px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        border-bottom: 3px solid #ccc;
    }

    .info-name {
        display: block;
        font-weight: 800;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }

    .info-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-size: 0.75rem;
    }

    /* Link wrapper agar bisa diklik */
    .contact-link {
        text-decoration: none;
        width: 100%;
        display: flex;
        justify-content: center;
        transition: transform 0.2s;
    }
    .contact-link:hover {
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 900px) {
        .contact-box {
            grid-template-columns: 1fr; /* Jadi 1 kolom di HP */
            gap: 50px;
        }
    }
</style>
@endsection

@section('content')

<div class="hero-contact">
    <div class="hero-content">
        <h1>HUBUNGI KAMI</h1>
    </div>
    <div class="hero-bottom-fade"></div>
</div>

<div class="contact-container">
    
    <h2 class="form-section-title">Formulir Aduan</h2>
    <div class="form-card">
        <form>
            <div class="form-group">
                <label>NAMA</label>
                <input type="text" class="form-control" placeholder="Masukkan nama Anda">
            </div>
            
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" class="form-control" placeholder="Masukkan Nomor Anda">
            </div>

            <div class="form-group">
                <label>Kritik & Saran</label>
                <textarea class="form-control" placeholder="Masukkan kritik dan saran"></textarea>
            </div>

            <button type="button" class="btn-submit">Submit</button>
        </form>
    </div>

    <h2 class="contact-section-title">Kontak Kami</h2>
    
    <div class="contact-box">
        
        <div class="contact-column">
            <i class="fab fa-whatsapp contact-icon-circle"></i>
            
            <a href="https://wa.me/6289670558961" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Zahratul Askia</span>
                    <span class="info-detail"><i class="fas fa-phone-alt"></i> +62 896-7055-8961</span>
                </div>
            </a>

            <a href="https://wa.me/6289695512607" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Ian Julian Sutrisno</span>
                    <span class="info-detail"><i class="fas fa-phone-alt"></i> +62 896-9551-2607</span>
                </div>
            </a>

            <a href="https://wa.me/62881024501933" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Yusuf Rafli Ahmad</span>
                    <span class="info-detail"><i class="fas fa-phone-alt"></i> +62 881-0245-01933</span>
                </div>
            </a>
        </div>

        <div class="contact-column">
            <i class="fab fa-instagram contact-icon-circle"></i>

            <a href="https://www.instagram.com/iamzahhh?igsh=MWk4ZTRhbGJtMWp6Ng==" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Zahratul Askia</span>
                    <span class="info-detail"><i class="fab fa-instagram"></i> @iamzahhh</span>
                </div>
            </a>

            <a href="https://www.instagram.com/gianjul_" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Ian Julian Sutrisno</span>
                    <span class="info-detail"><i class="fab fa-instagram"></i> @gianjul_</span>
                </div>
            </a>

            <a href="https://www.instagram.com/_yusuf_r_a?igsh=MWRzNG1iMnBjdTB0Zw==" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Yusuf Rafli Ahmad</span>
                    <span class="info-detail"><i class="fab fa-instagram"></i> @_yurah_r_a</span>
                </div>
            </a>
        </div>

        <div class="contact-column">
            <i class="fab fa-github contact-icon-circle"></i>

            <a href="https://github.com/radenjayden90" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Zahratul Askia</span>
                    <span class="info-detail"><i class="fab fa-github"></i> Zahratul Askia</span>
                </div>
            </a>

            <a href="https://github.com/IanJullian" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Ian Julian Sutrisno</span>
                    <span class="info-detail"><i class="fab fa-github"></i> Ian Julian Sutrisno</span>
                </div>
            </a>

            <a href="https://github.com/Yurah25" target="_blank" class="contact-link">
                <div class="info-card">
                    <span class="info-name">Yusuf Rafli Ahmad</span>
                    <span class="info-detail"><i class="fab fa-github"></i> Yurah25</span>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection