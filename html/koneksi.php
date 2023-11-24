<?php
$namaServer = "localhost";
$namaPengguana = "root";
$password = "";
$nama_db = "ediy";

$koneksi = new mysqli($namaServer, $namaPengguana, $password, $nama_db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error. "<br>");

}

?>