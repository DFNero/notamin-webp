<!-- controller\note_delete.php -->

<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: ../pages/dashboard.php");
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

mysqli_query(
    $conn,
    "DELETE FROM notes WHERE id=$id AND user_id=$user_id"
);

// 🔴 redirect BENAR
header("Location: ../pages/dashboard.php");
exit;
