<!-- controller\note_add.php -->

<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/dashboard.php");
    exit;
}

$title   = $_POST['title'];
$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

$query = "INSERT INTO notes (user_id, title, content)
          VALUES ('$user_id', '$title', '$content')";

mysqli_query($conn, $query);

// 🔴 REDIRECT YANG BENAR
header("Location: ../pages/dashboard.php");
exit;
