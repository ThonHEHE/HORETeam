<?php
// hapus.php

include 'koneksi.php';

$id = $_GET['id'];

// Fetch photo names from the database
$query_foto = "SELECT foto1, foto2, foto3 FROM wisata WHERE id=$id";
$result_foto = mysqli_query($koneksi, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);

// Define the image directory
$imageDirectory = '../img/';

// Delete foto1
$filename1 = $imageDirectory . $row_foto['foto1'];
unlink($filename1);

// Delete foto2
if (!empty($row_foto['foto2'])) {
    $filename2 = $imageDirectory . $row_foto['foto2'];
    unlink($filename2);
}

// Delete foto3
if (!empty($row_foto['foto3'])) {
    // Split the comma-separated filenames
    $foto3Array = explode(',', $row_foto['foto3']);
    
    // Loop through each filename and delete it
    foreach ($foto3Array as $filename3) {
        $filename3 = $imageDirectory . trim($filename3);
        unlink($filename3);
    }
}

// Delete data from the tabel wisata
$query = "DELETE FROM wisata WHERE id=$id";

if (mysqli_query($koneksi, $query)) {
    header('Location: homeAdmin.php');
    exit();
} else {
    echo 'Error: ' . mysqli_error($koneksi);
}
?>
