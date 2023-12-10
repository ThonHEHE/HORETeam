<?php
// tambah.php

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga_tiket = $_POST['harga_tiket'];
    $jam_operasional = $_POST['jam_operasional'];
    $fasilitas = $_POST['fasilitas'];
    $lokasi = $_POST['lokasi'];
    $id_kategori = $_POST['id_kategori'];
    $status = $_POST['status'];

    // Cek apakah file yang diunggah adalah file gambar
    $target_dir = "../img/";  // Direktori penyimpanan file
    $target_file1 = $target_dir . basename($_FILES["foto1"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["foto2"]["name"]);
    $uploadOk = 1;

    // Cek apakah file gambar valid
    $check = getimagesize($_FILES["foto1"]["tmp_name"]);
    if ($check !== false) {
        echo "File adalah gambar - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file1) || file_exists($target_file2)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Batasi jenis file yang diizinkan
    $imageFileType = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek apakah $uploadOk bernilai 0 karena ada kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file tidak diunggah.";
    } else {
        // Jika semuanya baik, coba unggah file foto pertama
        if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_file1)) {
            echo "File " . htmlspecialchars(basename($_FILES["foto1"]["name"])) . " telah berhasil diunggah.";
            $foto1 = $_FILES['foto1']['name']; // Set the file name for database insertion
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file foto pertama.";
        }

        // Jika semuanya baik, coba unggah file foto kedua
        if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $target_file2)) {
            echo "File " . htmlspecialchars(basename($_FILES["foto2"]["name"])) . " telah berhasil diunggah.";
            $foto2 = $_FILES['foto2']['name']; // Set the file name for database insertion
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file foto kedua.";
        }

        // Handling multiple files for foto3
        $foto3 = array(); // Initialize an empty array to store file names

        // Loop through each file in $_FILES['foto3']
        foreach ($_FILES['foto3']['tmp_name'] as $key => $tmp_name) {
            $target_file = $target_dir . basename($_FILES["foto3"]["name"][$key]);
            // Jika semuanya baik, coba unggah file foto ketiga
            if (move_uploaded_file($_FILES["foto3"]["tmp_name"][$key], $target_file)) {
                echo "File " . htmlspecialchars(basename($_FILES["foto3"]["name"][$key])) . " telah berhasil diunggah.";
                $foto3[] = $_FILES["foto3"]["name"][$key]; // Store the file name for database insertion
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file foto ketiga.";
            }
        }
    }

    $foto3_imploded = implode(",", $foto3); // Convert array to comma-separated string

    $query = "INSERT INTO wisata (nama, deskripsi, harga_tiket, jam_operasional, fasilitas, lokasi, id_kategori, foto1, foto2, foto3, status) VALUES ('$nama', '$deskripsi', '$harga_tiket', '$jam_operasional', '$fasilitas', '$lokasi', $id_kategori, '$foto1', '$foto2', '$foto3_imploded', '$status')";

    if (mysqli_query($koneksi, $query)) {
        header('Location: homeAdmin.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}

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
        <h2>Tambah Wisata</h2>
        <a href="homeAdmin.php" class="btn btn-secondary">Kembali ke Home</a>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="harga_tiket">Harga Tiket</label>
                <textarea class="form-control" name="harga_tiket" id="harga_tiket" required></textarea>
            </div>
            <div class="form-group">
                <label for="jam_operasional">Jam Operasional</label>
                <textarea class="form-control" name="jam_operasional" id="jam_operasional" required></textarea>
            </div>
            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea class="form-control" name="fasilitas" id="fasilitas" required></textarea>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" required>
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
                <label for="foto1">Foto 1</label>
                <input type="file" class="form-control-file" name="foto1" accept="image/*" required>
            </div>

            <!-- Form kedua -->
            <div class="form-group">
                <label for="foto2">Foto 2</label>
                <input type="file" class="form-control-file" name="foto2" accept="image/*" required>
            </div>

            <!-- Form ketiga -->
            <div class="form-group">
                <label for="foto3">Foto 3</label>
                <input type="file" class="form-control-file" name="foto3[]" accept="image/*" multiple required>
                <small class="form-text text-muted">Pilih satu atau lebih file gambar untuk Foto 3.</small>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="accept">Accept</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" formnovalidate="formnovalidate" >Submit Data</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#harga_tiket'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#jam_operasional'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#fasilitas'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>