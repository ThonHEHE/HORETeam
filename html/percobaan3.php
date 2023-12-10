<?php
// edit.php

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

// Periksa apakah parameter id_event telah diterima
if (!isset($_GET['id'])) {
    // Jika tidak, redirect ke halaman data event atau halaman lain yang sesuai
    header("Location: homeEvent.php"); // Gantilah dengan halaman data event yang benar
    exit();
}

$id_event = $_GET['id'];

// Ambil data event dari database berdasarkan id_event
$query = "SELECT * FROM event WHERE id = $id_event";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // Jika event tidak ditemukan, redirect ke halaman data event atau halaman lain yang sesuai
    header("Location: homeEvent.php"); // Gantilah dengan halaman data event yang benar
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir edit event
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

    // Jika ada foto baru diupload, hapus foto lama dan simpan yang baru
    if (!empty($foto)) {
        // Hapus foto lama
        $foto_lama = $row['foto'];
        $target_file_lama = "../img/" . $foto_lama;
        unlink($target_file_lama);

        // Simpan foto baru
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);

        // Update data event ke dalam database dengan foto baru
        $query_update = "UPDATE event SET nama='$nama', deskripsi='$deskripsi', detail='$detail', id_kategori='$id_kategori', lokasi='$lokasi', tanggal_event='$tanggal_event', tanggal_selese='$tanggal_selese', status_waktu='$status_waktu', foto='$foto', status='$status' WHERE id=$id_event";
    } else {
        // Jika tidak ada foto baru diupload, update data event ke dalam database tanpa mengubah foto
        $query_update = "UPDATE event SET nama='$nama', deskripsi='$deskripsi', detail='$detail', id_kategori='$id_kategori', lokasi='$lokasi', tanggal_event='$tanggal_event', tanggal_selese='$tanggal_selese', status_waktu='$status_waktu', status='$status' WHERE id=$id_event";
    }

    $result_update = mysqli_query($koneksi, $query_update);

    // Redirect ke halaman data event setelah berhasil mengedit event
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
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Event</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $row['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="detail">Detail:</label>
                <input type="text" class="form-control" id="detail" name="detail" value="<?= $row['detail']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori:</label>
                <select class="form-control" id="id_kategori" name="id_kategori" required>
                    <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                        <option value="<?= $row_kategori['id']; ?>" <?= ($row['id_kategori'] == $row_kategori['id']) ? 'selected' : ''; ?>>
                            <?= $row_kategori['nama_kategori']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $row['lokasi']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_event">Tanggal Event:</label>
                <input type="date" class="form-control" id="tanggal_event" name="tanggal_event" value="<?= $row['tanggal_event']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selese">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="tanggal_selese" name="tanggal_selese" value="<?= $row['tanggal_selese']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status_waktu">Status Waktu:</label>
                <select class="form-control" name="status_waktu" id="status_waktu" required>
                    <option value="past" <?= ($row['status_waktu'] == 'past') ? 'selected' : ''; ?>>Past</option>
                    <option value="upcoming" <?= ($row['status_waktu'] == 'upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <img src="../img/<?= $row['foto']; ?>" alt="Foto Event" class="img-thumbnail mb-2" style="max-width: 200px;">
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="pending" <?= ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="accept" <?= ($row['status'] == 'accept') ? 'selected' : ''; ?>>Accept</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" formnovalidate="formnovalidate">Simpan Perubahan</button>
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
