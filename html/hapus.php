<?php
// hapus.php

include 'koneksi.php';

$id = $_GET['id'];

$query_foto = "SELECT foto FROM wisata WHERE id=$id";
$result_foto = mysqli_query($koneksi, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);
$filename = 'uploads/' . $row_foto['foto'];

// Hapus foto dari folder uploads
unlink($filename);

// Hapus data dari tabel wisata
$query = "DELETE FROM wisata WHERE id=$id";

if (mysqli_query($koneksi, $query)) {
    header('Location: homeAdmin.php');
    exit();
} else {
    echo 'Error: ' . mysqli_error($koneksi);
}
?>
