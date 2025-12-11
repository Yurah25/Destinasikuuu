<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasiku - Yuk Eksplorasi Bersama</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- VARIABLES --- */
        :root {
            --primary-dark: #12284b; /* Navy */
            --primary-beige: #eae2d2; /* Cream */
            --accent-blue: #12284b;
            --text-white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--primary-beige);
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }

        /* --- TOP BAR (BARU) --- */
        .top-bar {
            background-color: var(--primary-dark);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* --- NAVBAR (REVISI) --- */
        nav {
            /* Tidak lagi fixed, jadi scroll ikut halaman */
            position: relative; 
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            
            /* Warna Background Cream Solid */
            background-color: var(--primary-beige); 
            color: var(--primary-dark); /* Teks jadi gelap */
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800; /* Lebih tebal sesuai gambar */
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary-dark);
        }
        
        /* Logo Image Style */
        .logo img {
            height: 40px; /* Sesuaikan ukuran logo */
        }

        .nav-links {
            display: flex;
            gap: 40px; /* Jarak antar menu diperlebar */
            align-items: center;
        }

        .nav-links a {
            font-size: 1rem;
            font-weight: 500;
            color: #555; /* Warna abu gelap */
            transition: 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary-dark);
            font-weight: 700;
        }
        
        /* Dropdown Icon untuk Explore */
        .fa-chevron-down {
            font-size: 0.7rem;
            margin-left: 5px;
        }

        .btn-login {
            background-color: var(--primary-dark); /* Tombol Navy */
            color: white !important;
            padding: 10px 35px;
            border-radius: 8px; /* Sudut lebih tumpul dikit */
            font-weight: 700 !important;
            font-size: 0.9rem;
        }

        .btn-login:hover {
            background-color: #1e293b;
        }

        /* --- FOOTER --- */
        footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 50px 5% 20px;
            margin-top: 0;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .footer-logo h2 { margin-bottom: 10px; }
        .footer-links ul li, .footer-team ul li { margin-bottom: 8px; font-size: 0.9rem; }
        
        .copyright {
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            font-size: 0.8rem;
        }
    </style>
    
    @yield('styles')
</head>
<body>

    <nav>
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/921/921490.png" alt="Logo"> 
            Destinasiku
        </div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#explore">Explore <i class="fas fa-chevron-down"></i></a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <a href="#" class="btn-login">LOGIN</a>
    </nav>
    <div class="top-bar">
        Selamat datang di website resmi “Destinasiku”
    </div>

    @yield('content')

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <div class="logo" style="color: white; margin-bottom: 15px;">
                     <img src="https://cdn-icons-png.flaticon.com/512/921/921490.png" alt="Logo" style="filter: brightness(0) invert(1);"> 
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
                    <li>Zahrotul Aida</li>
                    <li>Ian Julian Sutrisno</li>
                    <li>Yusuf Rafli Ahmad</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            Copyright &copy; 2025 Destinasiku Kelompok 6
        </div>
    </footer>

    @yield('scripts')
</body>
</html>