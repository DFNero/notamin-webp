<!-- components/note_detail.php -->

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
    <title><?= htmlspecialchars($note['title']); ?> - Notamin</title>
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
        .note-container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            max-width: 900px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .note-header {
            border-bottom: 2px solid #e1e8ed;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .note-title-display {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 15px;
        }
        .note-meta {
            color: #636e72;
            font-size: 0.95rem;
        }
        .note-content-display {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2d3436;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .action-buttons {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e1e8ed;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn-action {
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }
        .btn-back {
            background: #95a5a6;
            color: white;
        }
        .btn-back:hover {
            background: #7f8c8d;
            color: white;
        }
        .btn-edit {
            background: #f39c12;
            color: white;
        }
        .btn-edit:hover {
            background: #e67e22;
            color: white;
        }
        .btn-delete {
            background: #e74c3c;
            color: white;
        }
        .btn-delete:hover {
            background: #c0392b;
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
    <div class="header-title">📖 Detail Catatan</div>
    <div class="user-info">
        <span class="user-name">👤 <?= htmlspecialchars($user_name); ?></span>
        <button class="btn-logout" onclick="confirmLogout()">Logout</button>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="note-container">
        <div class="note-header">
            <h1 class="note-title-display"><?= htmlspecialchars($note['title']); ?></h1>
            <div class="note-meta">
                📅 Dibuat: <?= date('d F Y, H:i', strtotime($note['created_at'])); ?>
                <?php if ($note['updated_at'] != $note['created_at']): ?>
                    <br>✏️ Diperbarui: <?= date('d F Y, H:i', strtotime($note['updated_at'])); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="note-content-display">
            <?= nl2br(htmlspecialchars($note['content'])); ?>
        </div>

        <div class="action-buttons">
            <a href="../dashboard.php" class="btn-action btn-back">← Kembali</a>
            <a href="note_edit.php?id=<?= $note['id']; ?>" class="btn-action btn-edit">✏️ Edit</a>
            <a href="../../controller/note_delete.php?id=<?= $note['id']; ?>" 
               class="btn-action btn-delete" 
               onclick="return confirm('Yakin ingin menghapus catatan ini?')">🗑️ Hapus</a>
        </div>
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