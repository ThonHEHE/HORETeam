<?php
// editE.php

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

// Inisialisasi variabel
$id = $_GET['id'];
$error = '';

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi form data (sesuaikan dengan kebutuhan)
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $detail = $_POST['detail'];
    $lokasi = $_POST['lokasi'];
    $tanggal_event = $_POST['tanggal_event'];
    $tanggal_selese = $_POST['tanggal_selese'];
    $status_waktu = $_POST['status_waktu'];
    $status = $_POST['status'];

    // Update data event ke database
    $query = "UPDATE event SET
              nama = '$nama',
              deskripsi = '$deskripsi',
              detail = '$detail',
              lokasi = '$lokasi',
              tanggal_event = '$tanggal_event',
              tanggal_selese = '$tanggal_selese',
              status_waktu = '$status_waktu',
              status = '$status'
              WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        // Jika data berhasil diupdate, cek apakah ada file foto baru diupload
        if ($_FILES['foto']['name']) {
            // Hapus foto lama
            $queryFotoLama = "SELECT foto FROM event WHERE id = $id";
            $resultFotoLama = mysqli_query($koneksi, $queryFotoLama);
            $rowFotoLama = mysqli_fetch_assoc($resultFotoLama);
            $fotoLama = $rowFotoLama['foto'];
            unlink("../img/$fotoLama");

            // Upload foto baru
            $fotoBaru = $_FILES['foto']['name'];
            $tempName = $_FILES['foto']['tmp_name'];
            move_uploaded_file($tempName, "../img/$fotoBaru");

            // Update nama foto baru ke database
            $queryUpdateFoto = "UPDATE event SET foto = '$fotoBaru' WHERE id = $id";
            mysqli_query($koneksi, $queryUpdateFoto);
        }

        header("Location: homeAdmin.php");
        exit();
    } else {
        $error = "Gagal mengupdate data event: " . mysqli_error($koneksi);
    }
}

// Ambil data event yang akan diupdate
$querySelect = "SELECT * FROM event WHERE id = $id";
$resultSelect = mysqli_query($koneksi, $querySelect);
$rowSelect = mysqli_fetch_assoc($resultSelect);

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
        <form method="POST" enctype="multipart/form-data">
            <!-- Form fields sesuaikan dengan kolom-kolom tabel event -->
            <div class="form-group">
                <label for="nama">Nama Event:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $rowSelect['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $rowSelect['deskripsi']; ?></textarea>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <div class="form-group">
                <label for="foto">Foto Event:</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="detail">Detail:</label>
                <textarea class="form-control" id="detail" name="detail" required><?= $rowSelect['detail']; ?></textarea>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $rowSelect['lokasi']; ?>" required>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <div class="form-group">
                <label for="tanggal_event">Tanggal Event:</label>
                <input type="date" class="form-control" id="tanggal_event" name="tanggal_event" value="<?= $rowSelect['tanggal_event']; ?>" required>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <div class="form-group">
                <label for="tanggal_selese">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="tanggal_selese" name="tanggal_selese" value="<?= $rowSelect['tanggal_selese']; ?>" required>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <div class="form-group">
                <label for="status_waktu">Status Waktu:</label>
                <select class="form-control" id="status_waktu" name="status_waktu" required>
                    <option value="Upcoming" <?= ($rowSelect['status_waktu'] == 'Upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                    <option value="Past" <?= ($rowSelect['status_waktu'] == 'Past') ? 'selected' : ''; ?>>Past</option>
                </select>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                <option value="pending" <?= ($row_wisata['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="accept" <?= ($row_wisata['status'] == 'accept') ? 'selected' : ''; ?>>Accept</option></select>
            </div>
            <!-- Tambahkan field-form lain sesuai kebutuhan -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="homeAdmin.php" class="btn btn-secondary">Batal</a>
        </form>
        <?php
        if ($error) {
            echo '<div class="alert alert-danger mt-3">' . $error . '</div>';
        }
        ?>
    </div>
</body>

</html>

<?php
// Tutup koneksi setelah selesai menggunakan
mysqli_close($koneksi);
?>
