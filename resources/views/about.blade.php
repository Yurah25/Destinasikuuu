@extends('layouts.main')

@section('styles')
    <style>
        .hero-about {
            position: relative;
            height: 60vh;
            width: 100%;
            background: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2071&auto=format&fit=crop') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-about::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .hero-about-content {
            position: relative;
            z-index: 10;
        }

        .hero-about h1 {
            font-size: 3.5rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hero-about p {
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .hero-bottom-fade {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to top, var(--primary-beige), transparent);
        }

        .welcome-section {
            padding: 60px 10%;
            text-align: center;
            background-color: var(--primary-beige);
        }

        .welcome-section h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-weight: 800;
        }

        .divider {
            width: 100px;
            height: 5px;
            background-color: var(--primary-dark);
            margin: 10px auto 30px;
            border-radius: 5px;
        }

        .welcome-section p {
            font-size: 1rem;
            line-height: 1.8;
            color: #444;
            max-width: 800px;
            margin: 0 auto;
        }

        .background-section {
            padding: 60px 10%;
            background-color: var(--primary-beige);
            display: flex;
            justify-content: center;
        }

        .bg-card {
            background-color: var(--primary-dark);
            color: white;
            padding: 50px;
            border-radius: 30px;
            text-align: center;
            max-width: 900px;
        }

        .bg-card h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .bg-card p {
            font-size: 0.95rem;
            line-height: 1.8;
            color: #e0e0e0;
        }

        .goals-section {
            padding: 60px 10%;
            background-color: var(--primary-beige);
            text-align: center;
        }

        .goals-title-container {
            display: inline-block;
            background-color: var(--primary-dark);
            color: white;
            padding: 15px 40px;
            border-radius: 20px;
            margin-bottom: 50px;
        }

        .goals-title-container h2 {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .goals-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .goal-card {
            background-color: var(--primary-dark);
            color: white;
            padding: 40px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }

        .goal-card p {
            font-size: 0.95rem;
            line-height: 1.6;
        }


        @media (max-width: 768px) {
            .goals-grid {
                grid-template-columns: 1fr;
            }

            .hero-about h1 {
                font-size: 2.5rem;
            }
        }
    </style>
@endsection

@section('content')

    <header class="hero-about">
        <div class="hero-about-content">
            <h1>ABOUT US</h1>
            <p>Platform Informasi Wisata Terintegrasi</p>
        </div>
        <div class="hero-bottom-fade"></div>
    </header>


    <section class="welcome-section">
        <h2>Selamat Datang di DestinasiKu</h2>
        <div class="divider"></div>
        <p>
            Selamat datang di Destinasiku, platform informasi dan pendaftaran tempat wisata yang dirancang khusus untuk
            mempromosikan keindahan alam, budaya, kuliner, dan religi di daerah Purbalingga dan sekitarnya. Kami hadir untuk
            memudahkan Anda dalam menemukan destinasi wisata terbaik, lengkap dengan deskripsi, gambar, lokasi, dan fitur
            pencarian yang intuitif.
        </p>
    </section>


    <section class="background-section">
        <div class="bg-card">
            <h2>Latar Belakang</h2>
            <p>
                Destinasiku lahir dari proyek akademik mahasiswa Program Studi Informatika, Fakultas Teknik, Universitas
                Jenderal Soedirman, Purbalingga. Proyek ini dibuat untuk memenuhi tugas mata kuliah Pemrograman web I pada
                tahun 2025. Dengan perkembangan sektor pariwisata yang pesat di Indonesia, khususnya di wilayah Purbalingga,
                kami melihat kebutuhan akan sistem informasi terpusat yang dapat mengatasi masalah informasi wisata yang
                tersebar dan tidak terintegrasi. Website ini menyajikan data wisata secara komprehensif, membantu wisatawan
                domestik maupun mancanegara dalam merencanakan perjalanan mereka.
            </p>
        </div>
    </section>

    <section class="goals-section">
        <div class="goals-title-container">
            <h2>Tujuan Kami</h2>
        </div>

        <div class="goals-grid">
            <div class="goal-card">
                <p>Menyediakan platform user-friendly untuk menampilkan daftar tempat wisata di Purbalingga dan daerah
                    sekitarnya, termasuk fitur pencarian berdasarkan nama, lokasi, dan kategori.</p>
            </div>
            <div class="goal-card">
                <p>Memudahkan administrator dalam mengelola konten melalui sistem CRUD (Create, Read, Update, Delete) untuk
                    data wisata.</p>
            </div>
            <div class="goal-card">
                <p>Mempromosikan pariwisata lokal secara efektif, mendukung peningkatan kunjungan wisatawan, dan
                    berkontribusi pada ekonomi kreatif daerah.</p>
            </div>
            <div class="goal-card">
                <p>Mengaplikasikan teknologi web modern seperti HTML, CSS, JavaScript, PHP dengan framework Laravel, dan
                    database MySQL untuk pengalaman pengguna yang optimal.</p>
            </div>
        </div>
    </section>

@endsection