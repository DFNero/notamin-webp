<!-- components/note_edit.php -->

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require "../../config/database.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM notes WHERE id=$id AND user_id=$user_id"
);
$note = mysqli_fetch_assoc($query);

if (!$note) {
    echo "Catatan tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan - Notamin</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            z-index: 1000;
        }
        .sidebar-header {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            padding: 10px;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
        }
        .sidebar-menu li {
            margin-bottom: 10px;
        }
        .sidebar-menu a {
            display: block;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.2);
            padding-left: 20px;
        }
        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 70px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 999;
        }
        .header-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3436;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-name {
            font-weight: 600;
            color: #667eea;
        }
        .btn-logout {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: #c0392b;
        }
        /* Main Content */
        .main-content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }
        .form-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 800px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 25px;
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
        textarea.form-control {
            min-height: 200px;
            resize: vertical;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-back {
            background: #95a5a6;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-back:hover {
            background: #7f8c8d;
            color: white;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                padding: 0;
                overflow: hidden;
            }
            .header {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        📒 Notamin
    </div>
    <ul class="sidebar-menu">
        <li><a href="../dashboard.php">📋 Dashboard</a></li>
        <li><a href="note_add.php">➕ Tambah Catatan</a></li>
    </ul>
</div>

<!-- Header -->
<div class="header">
    <div class="header-title">✏️ Edit Catatan</div>
    <div class="user-info">
        <span class="user-name">👤 <?= htmlspecialchars($user_name); ?></span>
        <button class="btn-logout" onclick="confirmLogout()">Logout</button>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="form-container">
        <h2 class="form-title">Edit Catatan</h2>
        
        <form action="../../controller/note_edit.php" method="POST">
            <input type="hidden" name="id" value="<?= $note['id']; ?>">
            
            <div class="mb-3">
                <label class="form-label">📝 Judul Catatan</label>
                <input type="text" 
                       name="title" 
                       class="form-control" 
                       value="<?= htmlspecialchars($note['title']); ?>" 
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">📄 Isi Catatan</label>
                <textarea name="content" 
                          class="form-control" 
                          required><?= htmlspecialchars($note['content']); ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-submit">💾 Update Catatan</button>
                <a href="../dashboard.php" class="btn-back">← Kembali</a>
            </div>
        </form>
    </div>
</div>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script>
function confirmLogout() {
    if (confirm('Yakin ingin logout?')) {
        window.location.href = '../auth/logout.php';
    }
}
</script>
</body>
</html>