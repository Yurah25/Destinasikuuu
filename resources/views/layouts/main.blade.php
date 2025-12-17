<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasiku - Yuk Eksplorasi Bersama</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #12284b;
            --primary-beige: #eae2d2;
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

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        .top-bar {
            background-color: var(--primary-dark);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            font-weight: 500;
        }

        nav {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;

            background-color: var(--primary-beige);
            color: var(--primary-dark);
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary-dark);
        }

              .logo img {
            height: 40px;
         
        }

        .nav-links {
            display: flex;
            gap: 40px;
            
            align-items: center;
        }

        .nav-links a {
            font-size: 1rem;
            font-weight: 500;
            color: #555;
            
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary-dark);
            font-weight: 700;
        }

        .fa-chevron-down {
            font-size: 0.7rem;
            margin-left: 5px;
        }

        .btn-login {
            background-color: var(--primary-dark);
            color: white !important;
            padding: 10px 35px;
            border-radius: 8px;
            font-weight: 700 !important;
            font-size: 0.9rem;
        }

        .btn-login:hover {
            background-color: #1e293b;
        }

        footer {
            background-color: #15253F; 
            color: white;
            padding: 60px 8% 30px;
            margin-top: 50px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr; 
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo h2 { font-size: 1.8rem; margin-bottom: 5px; }
        
        .footer-links h3, .footer-team h3 {
            font-size: 1.1rem;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255,255,255,0.2);
            padding-bottom: 10px;
            display: inline-block;
        }

        .footer-links ul li, .footer-team ul li {
            margin-bottom: 12px;
            font-size: 0.95rem;
            color: #ccc;
        }
        
        .footer-team ul li i { margin-right: 8px; }

        .copyright {
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 25px;
            font-size: 0.85rem;
            color: #aaa;
        }
    </style>

    @yield('styles')
</head>

<body>

    <nav>
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            Destinasiku
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('explore') }}">Explore</a></li>
             <li><a href="{{ route('about') }}">About us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
    </nav>
    <div class="top-bar">
        Selamat datang di website resmi “Destinasiku”
    </div>

    @yield('content')

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
                    <li><i class="fab fa-github"></i> Ian Julian Sutrisno</li>
                    <li><i class="fab fa-github"></i> Yusuf Rafli Ahmad</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            Copyright &copy; 2025 Destinasiku, Kelompok 6
        </div>
    </footer>

    @yield('scripts')
</body>

</html>