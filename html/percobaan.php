<?php
// edit.php

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_wisata = $_POST['id']; // Assume you have a hidden input field for the ID
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga_tiket = $_POST['harga_tiket'];
    $jam_operasional = $_POST['jam_operasional'];
    $fasilitas = $_POST['fasilitas'];
    $lokasi = $_POST['lokasi'];
    $id_kategori = $_POST['id_kategori'];
    $status = $_POST['status'];

    // Check if the first photo is being updated
    if (!empty($_FILES["foto1"]["name"])) {
        // Delete the existing photo
        $query_delete_foto1 = "UPDATE wisata SET foto1 = NULL WHERE id = $id_wisata";
        mysqli_query($koneksi, $query_delete_foto1);

        // Upload the new photo
        $target_dir = "../img/";
        $target_file1 = $target_dir . basename($_FILES["foto1"]["name"]);
        if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_file1)) {
            $foto1 = $_FILES['foto1']['name'];
            echo "File " . htmlspecialchars(basename($_FILES["foto1"]["name"])) . " telah berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file foto pertama.";
        }
    }

    // Check if the second photo is being updated
    if (!empty($_FILES["foto2"]["name"])) {
        // Delete the existing photo
        $query_delete_foto2 = "UPDATE wisata SET foto2 = NULL WHERE id = $id_wisata";
        mysqli_query($koneksi, $query_delete_foto2);

        // Upload the new photo
        $target_file2 = $target_dir . basename($_FILES["foto2"]["name"]);
        if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $target_file2)) {
            $foto2 = $_FILES['foto2']['name'];
            echo "File " . htmlspecialchars(basename($_FILES["foto2"]["name"])) . " telah berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file foto kedua.";
        }
    }

    // Check if the third photo is being updated
    if (!empty($_FILES["foto3"]["name"][0])) {
        // Delete the existing photos
        $query_delete_foto3 = "UPDATE wisata SET foto3 = NULL WHERE id = $id_wisata";
        mysqli_query($koneksi, $query_delete_foto3);

        // Upload the new photos
        $foto3 = array();
        foreach ($_FILES['foto3']['tmp_name'] as $key => $tmp_name) {
            $target_file = $target_dir . basename($_FILES["foto3"]["name"][$key]);
            if (move_uploaded_file($_FILES["foto3"]["tmp_name"][$key], $target_file)) {
                echo "File " . htmlspecialchars(basename($_FILES["foto3"]["name"][$key])) . " telah berhasil diunggah.";
                $foto3[] = $_FILES["foto3"]["name"][$key];
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file foto ketiga.";
            }
        }
    }

    $foto3_imploded = implode(",", $foto3);

    $query = "UPDATE wisata SET 
                nama = '$nama', 
                deskripsi = '$deskripsi', 
                harga_tiket = '$harga_tiket', 
                jam_operasional = '$jam_operasional', 
                fasilitas = '$fasilitas', 
                lokasi = '$lokasi', 
                id_kategori = $id_kategori, 
                foto1 = IFNULL('$foto1', foto1), 
                foto2 = IFNULL('$foto2', foto2), 
                foto3 = IFNULL('$foto3_imploded', foto3), 
                status = '$status' 
              WHERE id = $id_wisata";

    if (mysqli_query($koneksi, $query)) {
        header('Location: homeAdmin.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}

// Fetch existing data for the selected item
$id_wisata = $_GET['id']; // Assume you pass the ID through the URL
$query_select = "SELECT * FROM wisata WHERE id = $id_wisata";
$result_select = mysqli_query($koneksi, $query_select);
$row_select = mysqli_fetch_assoc($result_select);

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
        <a href="homeAdmin.php" class="btn btn-secondary">Kembali ke Home</a>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row_select['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="harga_tiket">Harga Tiket</label>
                <input type="text" class="form-control" name="harga_tiket" required>
            </div>
            <div class="form-group">
                <label for="jam_operasional">Jam Operasional</label>
                <input type="text" class="form-control" name="jam_operasional" required>
            </div>
            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea class="form-control" name="fasilitas" required></textarea>
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
                <input type="file" class="form-control-file" name="foto1" accept="image/*">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            </div>

            <!-- Form kedua -->
            <div class="form-group">
                <label for="foto2">Foto 2</label>
                <input type="file" class="form-control-file" name="foto2" accept="image/*">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            </div>

            <!-- Form ketiga -->
            <div class="form-group">
                <label for="foto3">Foto 3</label>
                <input type="file" class="form-control-file" name="foto3[]" accept="image/*" multiple>
                <small class="form-text text-muted">Pilih satu atau lebih file gambar untuk Foto 3. Kosongkan jika tidak ingin mengganti foto.</small>
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