<!-- index.php -->

<?php
session_start();

// kalau sudah login, arahkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: pages/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notamin - Catatan Aman</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .landing-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 50px;
            max-width: 700px;
            margin: 0 auto;
        }
        .logo {
            font-size: 4rem;
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #667eea;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }
        .tagline {
            text-align: center;
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        .features {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
        }
        .features h3 {
            color: #667eea;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .features ul {
            list-style: none;
            padding: 0;
        }
        .features li {
            padding: 10px 0;
            font-size: 1.05rem;
            color: #495057;
        }
        .btn-custom {
            padding: 12px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-outline-custom {
            border: 2px solid #667eea;
            color: #667eea;
            background: white;
        }
        .btn-outline-custom:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        .footer-text {
            text-align: center;
            color: #6c757d;
            margin-top: 30px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="landing-container">
        <div class="logo">📒</div>
        <h1>Notamin</h1>
        
        <p class="tagline">
            Aplikasi pencatatan sederhana berbasis web untuk menyimpan catatan secara aman dan terorganisir.
        </p>

        <div class="features">
            <h3>Fitur Utama</h3>
            <ul>
                <li>📝 Membuat dan mengelola catatan</li>
                <li>🔐 Sistem login & register</li>
                <li>📂 Data tersimpan di database</li>
                <li>⚡ Dibuat dengan PHP Native</li>
            </ul>
        </div>

        <div class="text-center mt-4">
            <a href="pages/auth/login.php" class="btn btn-custom btn-primary-custom me-2">Login</a>
            <a href="pages/auth/register.php" class="btn btn-custom btn-outline-custom">Register</a>
        </div>

        <p class="footer-text">
            Project Web Programming – PHP Native
        </p>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>