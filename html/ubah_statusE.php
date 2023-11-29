<?php
// ubah_status.php

include 'koneksi.php';

$id = $_GET['id'];

$query_wisata = "SELECT status FROM event WHERE id=$id";
$result_wisata = mysqli_query($koneksi, $query_wisata);
$row_wisata = mysqli_fetch_assoc($result_wisata);

$new_status = ($row_wisata['status'] == 'pending') ? 'accept' : 'pending';

$query = "UPDATE event SET status='$new_status' WHERE id=$id";

if (mysqli_query($koneksi, $query)) {
    header('Location: homeEvent.php');
    exit();
} else {
    echo 'Error: ' . mysqli_error($koneksi);
}
?>
