<!-- register.php -->

<?php
session_start();
require "../../config/database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Notamin</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
        }
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-icon {
            font-size: 4rem;
            margin-bottom: 15px;
        }
        .register-title {
            color: #667eea;
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .register-subtitle {
            color: #6c757d;
            font-size: 0.95rem;
        }
        .form-label {
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 8px;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 2px solid #e1e8ed;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .back-home {
            text-align: center;
            margin-top: 15px;
        }
        .back-home a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .back-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-container">
        <div class="register-header">
            <div class="register-icon">📝</div>
            <h1 class="register-title">Register</h1>
            <p class="register-subtitle">Buat akun Notamin baru</p>
        </div>

        <form action="../../controller/register_process.php" method="POST">
            <div class="mb-3">
                <label class="form-label">👤 Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label">📧 Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">🔒 Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
            </div>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>

        <div class="back-home">
            <a href="../../index.php">← Kembali ke beranda</a>
        </div>
    </div>
</div>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>