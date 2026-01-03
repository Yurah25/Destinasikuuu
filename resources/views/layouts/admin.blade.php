<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Destinasiku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body {
            background-color: #FFFBF0; 
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background-color: #E0E0E0;
            display: flex;
            flex-direction: column;
            padding: 30px 0;
            flex-shrink: 0;
            border-right: 1px solid #ccc;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 50px;
            padding: 0 20px;
        }
        .sidebar-logo img { width: 80px; margin-bottom: 10px; }
        .sidebar-logo h2 { color: #1A3052; font-weight: 800; font-size: 1.4rem; text-transform: uppercase; }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 30px;
            color: #1A3052;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: 0.3s;
            gap: 15px;
        }

        .menu-item:hover, .menu-item.active {
            background-color: #d6d6d6;
            color: black;
        }

        .menu-item i { font-size: 1.5rem; width: 30px; text-align: center; }

        .btn-logout {
            margin: auto 30px 20px;
            background-color: #1A3052;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            background-color: #FFFBF0;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #1A3052;
        }
        
        .top-bar-left a {
            text-decoration: none;
            color: #1A3052;
            font-weight: 700;
            display: flex; align-items: center; gap: 5px;
        }

        .top-bar-center {
            display: flex; align-items: center; gap: 10px;
            color: #1A3052; font-weight: 800; font-size: 1.5rem;
        }
        .top-bar-center img { height: 35px; }

        .sub-header {
            background-color: #1A3052;
            color: white;
            text-align: center;
            padding: 10px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .page-content {
            padding: 40px;
            flex-grow: 1;
        }

    
        .admin-footer {
            background-color: #1A3052;
            color: white;
            padding: 40px 50px;
            margin-top: auto;
        }
        .footer-grid {
            display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 30px;
            margin-bottom: 20px;
        }
        .footer-grid h4 { border-bottom: 1px solid #aaa; padding-bottom: 5px; margin-bottom: 10px; display: inline-block;}
        .footer-copyright { text-align: center; font-size: 0.8rem; color: #ccc; border-top: 1px solid #444; padding-top: 20px; }
        
        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .admin-table thead th {
            background-color: #1A3052;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        .admin-table thead th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .admin-table thead th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

        .admin-table tbody tr {
            background-color: #e0e0e0; 
        }
        
        .admin-table td {
            padding: 10px;
            vertical-align: middle;
        }
        
        .data-box {
            background-color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            color: #555;
            min-height: 40px;
            display: flex; align-items: center;
        }

        .breadcrumb {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.2rem; font-weight: 700; color: #1A3052;
            margin-bottom: 30px;
            text-transform: uppercase;
        }
        .search-box {
            display: flex;
            background: #dcdcdc;
            border-radius: 5px;
            overflow: hidden;
            width: 300px;
        }
        .search-box input {
            border: none; background: transparent; padding: 10px; width: 100%; outline: none;
        }
        .search-box button {
            background: #1A3052; color: white; border: none; padding: 0 15px; cursor: pointer;
        }
        /* Mengecilkan ukuran navigasi halaman (pagination) */
.pagination {
    display: flex;
    gap: 5px;
    list-style: none;
    padding: 0;
}

.pagination li a, .pagination li span {
    padding: 5px 10px; /* Ukuran padding diperkecil */
    font-size: 12px;    /* Ukuran teks diperkecil */
    border: 1px solid #1A3052;
    border-radius: 4px;
    color: #1A3052;
    text-decoration: none;
    background: white;
}

.pagination li.active span {
    background: #1A3052;
    color: white;
}
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h2>Admin Panel</h2>
        </div>

        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> BERANDA
        </a>
        <a href="{{ route('dashboard.wisata') }}" class="menu-item {{ request()->routeIs('dashboard.wisata') ? 'active' : '' }}">
            <i class="fas fa-map-pin"></i> KELOLA WISATA
        </a>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
            @csrf
            <button type="submit" class="btn-logout" style="width: 80%; margin-left: 10%;">LOGOUT</button>
        </form>
    </div>

    <div class="main-content">
        
        <div class="top-bar">
            <div class="top-bar-left">
                <a href="{{ route('home') }}"><i class="fas fa-chevron-left"></i> Kembali</a>
            </div>
            <div class="top-bar-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                Destinasiku
            </div>
            <div style="width: 80px;"></div> </div>

        <div class="sub-header">
            Selamat Datang {{ Auth::user()->username ?? 'Admin' }} di Halaman Dashboard
        </div>

        <div class="page-content">
            @yield('content')
        </div>

        <div class="admin-footer">
            <div class="footer-grid">
                <div>
                    <img src="{{ asset('img/logo.png') }}" style="filter: brightness(0) invert(1); height: 40px; margin-bottom:10px;">
                    <h3 style="color:white;">Destinasiku</h3>
                </div>
                <div>
                    <h4>Jelajahi</h4>
                    <ul style="list-style:none; font-size:0.9rem; color:#ccc;">
                        <li>Home</li>
                        <li>Explore</li>
                        <li>About us</li>
                        <li>Contact</li>
                    </ul>
                </div>
                <div>
                    <h4>Tim Pengembang</h4>
                    <ul style="list-style:none; font-size:0.9rem; color:#ccc;">
                        <li><i class="fab fa-github"></i> Zahratul Askia</li>
                        <li><i class="fab fa-github"></i> Ian Jullian Sutrisno</li>
                        <li><i class="fab fa-github"></i> Yusuf Rafii Ahmad</li>
                    </ul>
                </div>
            </div>
            <div class="footer-copyright">
                Copyright © 2025 Destinasiku, Kelompok 6
            </div>
        </div>
    </div>

</body>
</html>