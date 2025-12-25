<!-- controller\login_process.php -->

<?php
session_start();
require "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/auth/login.php");
    exit;
}

$email    = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user  = mysqli_fetch_assoc($query);

if ($user && password_verify($password, $user['password'])) {

    // set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name']    = $user['name'];

    // WAJIB redirect + exit
    header("Location: ../pages/dashboard.php");
    exit;

} else {
    // gagal login → balik ke login
    header("Location: ../pages/auth/login.php?error=1");
    exit;
}
