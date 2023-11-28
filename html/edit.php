<?php
// edit.php

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga_tiket = $_POST['harga_tiket'];
    $jam_operasional = $_POST['jam_operasional'];
    $fasilitas = $_POST['fasilitas'];
    $lokasi = $_POST['lokasi'];
    $id_kategori = $_POST['id_kategori'];
    $status = $_POST['status'];

    $query = "UPDATE wisata SET nama='$nama', deskripsi='$deskripsi', harga_tiket=$harga_tiket, jam_operasional='$jam_operasional', fasilitas='$fasilitas', lokasi='$lokasi', id_kategori=$id_kategori, status='$status' WHERE id=$id";

    if (mysqli_query($koneksi, $query)) {
        header('Location: homeAdmin.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}

$id = $_GET['id'];
$query_wisata = "SELECT * FROM wisata WHERE id=$id";
$result_wisata = mysqli_query($koneksi, $query_wisata);
$row_wisata = mysqli_fetch_assoc($result_wisata);

$query_kategori = "SELECT * FROM kategori_wisata";
$result_kategori = mysqli_query($koneksi, $query_kategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wisata</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Edit Wisata</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $row_wisata['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $row_wisata['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required><?= $row_wisata['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="harga_tiket">Harga Tiket</label>
                <input type="number" class="form-control" name="harga_tiket" value="<?= $row_wisata['harga_tiket']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jam_operasional">Jam Operasional</label>
                <input type="text" class="form-control" name="jam_operasional" value="<?= $row_wisata['jam_operasional']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea class="form-control" name="fasilitas" required><?= $row_wisata['fasilitas']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="<?= $row_wisata['lokasi']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori</label>
                <select class="form-control" name="id_kategori" required>
                    <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                        <option value="<?= $row_kategori['id']; ?>" <?= ($row_kategori['id'] == $row_wisata['id_kategori']) ? 'selected' : ''; ?>><?= $row_kategori['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pending" <?= ($row_wisata['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="accept" <?= ($row_wisata['status'] == 'accept') ? 'selected' : ''; ?>>Accept</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
