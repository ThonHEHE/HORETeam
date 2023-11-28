<?php
// hapus.php

include 'koneksi.php';

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the event with the specified ID from the database
    $query = "DELETE FROM event WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        // Handle the error or redirect as needed
        die("Error: " . mysqli_error($koneksi));
    }
}

// Redirect to the appropriate page after deleting
header("Location: homeAdmin.php");
exit();

// Close the database connection
?>
