<!-- controller\register_process.php -->

<?php
session_start();
require "../config/database.php";

$name     = htmlspecialchars($_POST['name']);
$email    = htmlspecialchars($_POST['email']);
$password = $_POST['password'];

// hash password
$hashPassword = password_hash($password, PASSWORD_DEFAULT);

// cek email udah ada atau belum
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
  echo "Email sudah terdaftar!";
  exit;
}

// insert ke database
$query = "INSERT INTO users (name, email, password) 
          VALUES ('$name', '$email', '$hashPassword')";

if (mysqli_query($conn, $query)) {
  header("Location: ../pages/auth/login.php");
} else {
  echo "Register gagal!";
}
