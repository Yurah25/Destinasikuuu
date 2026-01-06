<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Destinasiku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body { 
            background-color: #f0f0f0; 
            overflow-x: hidden;
        }

        /* --- HEADER KHUSUS --- */
        .header-top {
            background-color: #FFFBF0; /* Cream */
            padding: 15px 5%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .btn-back {
            position: absolute;
            left: 5%;
            text-decoration: none;
            color: #1A3052;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1A3052;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo img { height: 40px; }

        .header-sub {
            background-color: #1A3052; /* Navy */
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* --- LOGIN SECTION --- */
        .login-wrapper {
            /* Background Pantai */
            background: url('https://images.unsplash.com/photo-1540206351-d6465b3ac5c1?q=80&w=2064&auto=format&fit=crop') no-repeat center center/cover;
            min-height: 85vh; /* Sisa tinggi layar */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .demo-box {
    margin-top: 20px;
    padding: 10px;
    background-color: #e8f0fe;
    border: 1px dashed #1A3052;
    border-radius: 8px;
    font-size: 0.85rem;
    color: #1A3052;
    text-align: left;
}
.demo-box strong { display: block; margin-bottom: 5px; text-transform: uppercase; }

        /* Overlay gelap sedikit biar teks terbaca jika background terang */
        .login-wrapper::before {
            content: ''; position: absolute; top:0; left:0; width:100%; height:100%;
            background: rgba(0,0,0,0.1);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.85); /* Putih Transparan */
            backdrop-filter: blur(10px); /* Efek Blur Kaca */
            padding: 40px 50px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            position: relative;
            z-index: 10;
            text-align: center;
        }

        .login-title {
            color: #1A3052;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            color: #1A3052;
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .form-group label i { margin-right: 5px; }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .form-control:focus { outline: 2px solid #1A3052; }

        .btn-submit {
            background-color: #1A3052;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-submit:hover { background-color: #0f1c30; }

        .error-msg {
            background: #ffcdd2; color: #c62828;
            padding: 10px; border-radius: 5px;
            margin-bottom: 20px; font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="header-top">
        <a href="{{ route('home') }}" class="btn-back">
            <i class="fas fa-chevron-left"></i> Kembali
        </a>
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            Destinasiku
        </div>
    </div>

    <div class="header-sub">
        ~ Login Page Untuk Admin Destinasiku ~
    </div>

    <div class="login-wrapper">
        <div class="login-card">
            <h1 class="login-title">Login</h1>

            @if(session()->has('loginError'))
                <div class="error-msg">
                    {{ session('loginError') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required autofocus>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-key"></i> Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                </div>

                <button type="submit" class="btn-submit">LOGIN</button>
            </form>
            <div class="demo-box">
    <strong><i class="fas fa-info-circle"></i> Demo Akun</strong>
    Username: <code>Mindes</code> <br>
    Password: <code>Mindes123</code>
</div>
        </div>
    </div>

</body>
</html>