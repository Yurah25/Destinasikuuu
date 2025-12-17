<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Destinasiku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #FFFBF0; } /* Cream Background */

        /* --- HEADER SAMA SEPERTI LOGIN --- */
        .header-top {
            background-color: #FFFBF0;
            padding: 20px 5%;
            display: flex;
            justify-content: center;
            border-bottom: 1px solid #ddd;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1A3052;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo img { height: 45px; }

        .header-sub {
            background-color: #1A3052;
            color: white;
            text-align: center;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* --- CONTENT --- */
        .dashboard-content {
            padding: 50px 10%;
            text-align: center;
        }

        /* Kartu Selamat Datang */
        .welcome-card {
            background-color: #1A3052;
            color: white;
            border-radius: 30px;
            padding: 50px;
            text-align: left;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 60px;
        }

        .welcome-text {
            max-width: 60%;
            position: relative;
            z-index: 2;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .welcome-text p {
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .welcome-footer {
            font-weight: 700;
            font-size: 1rem;
        }

        /* Ilustrasi di kanan kartu (Placeholder Logo Besar) */
        .welcome-img {
            max-width: 35%;
            opacity: 0.9;
        }

        .welcome-img img {
            width: 100%;
            height: auto;
        }

        /* --- TIM PENGEMBANG --- */
        .team-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1A3052;
            margin-bottom: 40px;
            text-decoration: underline;
            text-underline-offset: 10px;
        }

        .team-section {
            background-color: #1A3052;
            padding: 60px 10%;
            color: white;
            text-align: center;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .team-member {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .photo-circle {
            width: 180px;
            height: 180px;
            background-color: #D32F2F; /* Merah Background Foto */
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .member-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .member-nim {
            font-size: 1rem;
            font-weight: 600;
            opacity: 0.9;
            text-transform: uppercase;
        }

        /* --- BUTTON SECTION --- */
        .action-area {
            background-color: #FFFBF0;
            padding: 40px;
            text-align: right;
            padding-right: 10%;
        }

        .btn-page-menu {
            background-color: #1A3052;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
        }

        /* --- FOOTER (SAMA SEPERTI MAIN) --- */
        footer {
            background-color: #15253F;
            color: white;
            padding: 50px 8% 20px;
        }
        .footer-content {
            display: grid; grid-template-columns: 1.5fr 1fr 1fr; gap: 40px; margin-bottom: 40px;
            text-align: left;
        }
        .copyright {
            text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 25px;
            font-size: 0.85rem; color: #aaa;
        }
        .footer-links h3, .footer-team h3 { border-bottom: 2px solid rgba(255,255,255,0.2); padding-bottom:10px; margin-bottom:15px; display:inline-block; }
        ul { list-style: none; }
        li { margin-bottom: 8px; color: #ccc; }
    </style>
</head>
<body>

    <div class="header-top">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            Destinasiku
        </div>
    </div>

    <div class="header-sub">
        Selamat Datang {{ Auth::user()->username ?? 'Admin' }} di Halaman Dashboard
    </div>

    <div class="dashboard-content">
        <div class="welcome-card">
            <div class="welcome-text">
                <h1>SELAMAT DATANG</h1>
                <p>
                    Destinasiku merupakan platform yang dikembangkan oleh kelompok 6 dalam rangka memenuhi tugas besar mata kuliah Analisis Desain dan Sistem dan Pemrograman Web (A). Platform ini dirancang untuk membantu calon wisatawan menemukan informasi destinasi secara cepat, mudah, dan akurat.
                </p>
                <div class="welcome-footer">Yuk Eksplorasi bersama MinDes!</div>
            </div>
            <div class="welcome-img">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Besar">
            </div>
        </div>

        <h2 class="team-title">Tim Pengembang</h2>
    </div>

    <div class="team-section">
        <div class="team-grid">
            <div class="team-member">
                <div class="photo-circle">
                    <img src="https://ui-avatars.com/api/?name=Zahratul+Askia&background=random&color=fff" alt="Zahratul">
                </div>
                <div class="member-name">Zahratul Askia</div>
                <div class="member-nim">H1D024016</div>
            </div>

            <div class="team-member">
                <div class="photo-circle">
                    <img src="https://ui-avatars.com/api/?name=Ian+Julian&background=random&color=fff" alt="Ian">
                </div>
                <div class="member-name">Ian Jullian Sutrisno</div>
                <div class="member-nim">H1D024039</div>
            </div>

            <div class="team-member">
                <div class="photo-circle">
                    <img src="https://ui-avatars.com/api/?name=Yusuf+Rafli&background=random&color=fff" alt="Yusuf">
                </div>
                <div class="member-name">Yusuf Rafii Ahmad</div>
                <div class="member-nim">H1D024049</div>
            </div>
        </div>
    </div>

    <div class="action-area">
        <a href="{{ route('dashboard.wisata') }}" class="btn-page-menu">GO TO PAGE MENU</a>
        
        <form action="{{ route('logout') }}" method="POST" style="display:inline-block; margin-left:10px;">
            @csrf
            <button type="submit" class="btn-page-menu" style="background:#c62828;">LOGOUT</button>
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <div class="logo" style="color: white; margin-bottom: 15px;">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="filter: brightness(0) invert(1);">
                    Destinasiku
                </div>
            </div>
            <div class="footer-links">
                <h3>Jelajahi</h3>
                <ul>
                    <li>Home</li>
                    <li>Explore</li>
                    <li>About Us</li>
                    <li>Contact</li>
                </ul>
            </div>
            <div class="footer-team">
                <h3>Tim Pengembang</h3>
                <ul>
                    <li><i class="fab fa-github"></i> Zahratul Askia</li>
                    <li><i class="fab fa-github"></i> Ian Jullian Sutrisno</li>
                    <li><i class="fab fa-github"></i> Yusuf Rafii Ahmad</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            Copyright &copy; 2025 Destinasiku, Kelompok 6
        </div>
    </footer>

</body>
</html>