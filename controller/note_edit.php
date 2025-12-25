<!-- controller\note_edit.php -->

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


if (!isset($_POST['id'], $_POST['title'], $_POST['content'])) {
    header("Location: ../pages/dashboard.php");
    exit;
}

$id      = $_POST['id'];
$title   = $_POST['title'];
$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

mysqli_query(
    $conn,
    "UPDATE notes
     SET title='$title', content='$content'
     WHERE id=$id AND user_id=$user_id"
);

// 🔴 redirect YANG BENAR
header("Location: ../pages/dashboard.php");
exit;
