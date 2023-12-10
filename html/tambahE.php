<?php
// tambahE.php

include 'koneksi.php';

session_start();

// Periksa apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    session_unset();
    session_destroy();
    // Jika tidak, redirect ke halaman login atau halaman lain yang sesuai
    header("Location: login.php"); // Gantilah dengan halaman login yang benar
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir tambah event
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $detail = $_POST['detail'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $tanggal_event = $_POST['tanggal_event'];
    $tanggal_selese = $_POST['tanggal_selese'];
    $status_waktu = $_POST['status_waktu'];
    $foto = $_FILES['foto']['name']; // Ambil nama file gambar
    $status = $_POST['status'];

    // Simpan foto ke folder img
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);

    // Insert data event ke dalam database
    $query = "INSERT INTO event (nama, deskripsi, detail, id_kategori, lokasi, tanggal_event, tanggal_selese, status_waktu, foto, status) 
              VALUES ('$nama', '$deskripsi', '$detail', '$id_kategori', '$lokasi', '$tanggal_event', '$tanggal_selese', '$status_waktu', '$foto', '$status')";
     $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman data event setelah berhasil menambahkan event
    header("Location: homeEvent.php");
    exit();
}

// Ambil data kategori event untuk ditampilkan dalam dropdown
$query_kategori = "SELECT * FROM kategori_event";
$result_kategori = mysqli_query($koneksi, $query_kategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Event</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="nama">Detail:</label>
                <input type="text" class="form-control" id="detail" name="detail" required>
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori:</label>
                <select class="form-control" id="id_kategori" name="id_kategori" required>
                    <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                        <option value="<?= $row_kategori['id']; ?>"><?= $row_kategori['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
            </div>
            <div class="form-group">
                <label for="tanggal_event">Tanggal Event:</label>
                <input type="date" class="form-control" id="tanggal_event" name="tanggal_event" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selese">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="tanggal_selese" name="tanggal_selese" required>
            </div>
            <div class="form-group">
                <label for="status_waktu">Status Waktu:</label>
                <select class="form-control" name="status_waktu" id="status_waktu" required>
                    <option value="past">Past</option>
                    <option value="upcoming">Upcoming</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control-file" id="foto" name="foto" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="pending">Pending</option>
                    <option value="accept">Accept</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" formnovalidate="formnovalidate">Tambah Event</button>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>

<?php
// Tutup koneksi setelah selesai menggunakan
mysqli_close($koneksi);
?>
