<?php
// tambah.php

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Cek apakah file yang diunggah adalah file gambar
$target_dir = "../img/";  // Direktori penyimpanan file
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah file gambar valid
$check = getimagesize($_FILES["foto"]["tmp_name"]);
if ($check !== false) {
    echo "File adalah gambar - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File bukan gambar.";
    $uploadOk = 0;
}

// Cek apakah file sudah ada
if (file_exists($target_file)) {
    echo "Maaf, file sudah ada.";
    $uploadOk = 0;
}

// Batasi jenis file yang diizinkan
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    $uploadOk = 0;
}

// Cek apakah $uploadOk bernilai 0 karena ada kesalahan
if ($uploadOk == 0) {
    echo "Maaf, file tidak diunggah.";
} else {
    // Jika semuanya baik, coba unggah file
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        echo "File " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " telah berhasil diunggah.";
        $foto = $_FILES['foto']['name']; // Set the file name for database insertion
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
}
move_uploaded_file($foto_temp, $foto_path);

    $query = "INSERT INTO event (id_kategori, nama, deskripsi, lokasi, tanggal_event, foto, status) VALUES ('$id_kategori','$nama','$deskripsi','$lokasi','$tanggal','$foto','$status')";
    
    if (mysqli_query($koneksi, $query)) {
        header('Location: homeEvent.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}

$query_kategori = "SELECT * FROM kategori_event";
$result_kategori = mysqli_query($koneksi, $query_kategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Tambah Event</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori</label>
                <select class="form-control" name="id_kategori" required>
                    <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                        <option value="<?= $row_kategori['id']; ?>"><?= $row_kategori['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Event</label>
                <input type="text" class="form-control" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="accept">Accept</option>
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
