<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    session_unset();
    session_destroy();
    // Jika tidak, redirect ke halaman login atau halaman lain yang sesuai
    header("Location: login.php"); // Gantilah dengan halaman login yang benar
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Halaman User</h1>
    <a href="homeAdmin.php">Home</a>
    <a href="logout.php">Logout</a>
    <hr>
    <?php
    // Display welcome message with username
    echo "<h1>Selamat datang, " . $_SESSION['user']['username'] . "</h1>";
    ?>
    Halaman ini akan tampil setelah user login
</body>
</html>
