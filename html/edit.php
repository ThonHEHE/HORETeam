<?php
// edit.php

include 'koneksi.php';

$id = $_GET['id'];
$query_wisata = "SELECT * FROM wisata WHERE id=$id";
$result_wisata = mysqli_query($koneksi, $query_wisata);

if (!$result_wisata) {
    die('Error fetching data: ' . mysqli_error($koneksi));
}

$row_wisata = mysqli_fetch_assoc($result_wisata);

$query_kategori = "SELECT * FROM kategori_wisata";
$result_kategori = mysqli_query($koneksi, $query_kategori);

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

    // Initialize variables for new photos with existing paths
    $newFoto1 = $row_wisata['foto1'];
    $newFoto2 = $row_wisata['foto2'];
    $newFoto3 = $row_wisata['foto3'];

    // Handling file uploads for new_foto1
    if ($_FILES['new_foto1']['error'] == 0) {
        // Delete the previous photo if it exists
        if (!empty($row_wisata['foto1'])) {
            unlink('../img/' . $row_wisata['foto1']);
        }

        $newFoto1 = $_FILES['new_foto1']['name'];
        $uploadPath1 = '../img/' . $newFoto1;
        move_uploaded_file($_FILES['new_foto1']['tmp_name'], $uploadPath1);
    }

    // Handling file uploads for new_foto2
    if ($_FILES['new_foto2']['error'] == 0) {
        // Delete the previous photo if it exists
        if (!empty($row_wisata['foto2'])) {
            unlink('../img/' . $row_wisata['foto2']);
        }

        $newFoto2 = $_FILES['new_foto2']['name'];
        $uploadPath2 = '../img/' . $newFoto2;
        move_uploaded_file($_FILES['new_foto2']['tmp_name'], $uploadPath2);
    }

    // Handling file uploads for new_foto3
    if (!empty($_FILES['new_foto3']['name'][0])) {
        // Delete the previous photos if they exist
        if (!empty($row_wisata['foto3'])) {
            $previousPhotos = explode(',', $row_wisata['foto3']);
            foreach ($previousPhotos as $previousPhoto) {
                unlink('../img/' . $previousPhoto);
            }
        }

        $newFoto3 = implode(',', $_FILES['new_foto3']['name']);
        foreach ($_FILES['new_foto3']['tmp_name'] as $key => $tmp_name) {
            $uploadPath3 = '../img/' . $_FILES['new_foto3']['name'][$key];
            move_uploaded_file($tmp_name, $uploadPath3);
        }
    }

    // Update the database with the new image paths
    $query = "UPDATE wisata SET nama='$nama', deskripsi='$deskripsi', harga_tiket='$harga_tiket', jam_operasional='$jam_operasional', fasilitas='$fasilitas', lokasi='$lokasi', id_kategori=$id_kategori, foto1='$newFoto1', foto2='$newFoto2', foto3='$newFoto3', status='$status' WHERE id=$id";

    if (mysqli_query($koneksi, $query)) {
        header('Location: homeAdmin.php');
        exit();
    } else {
        echo 'Error updating data: ' . mysqli_error($koneksi);
    }
}
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
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row_wisata['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $row_wisata['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" cols="50"
                    required><?= $row_wisata['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="harga_tiket">Harga Tiket</label>
                <textarea class="form-control" name="harga_tiket" id="harga_tiket" rows="6" cols="50"
                    required><?= $row_wisata['harga_tiket']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="jam_operasional">Jam Operasional</label>
                <textarea class="form-control" name="jam_operasional" id="jam_operasional" rows="6" cols="50"
                    required><?= $row_wisata['jam_operasional']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea class="form-control" name="fasilitas" id="fasilitas" rows="6" cols="50"
                    required><?= $row_wisata['fasilitas']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="<?= $row_wisata['lokasi']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori</label>
                <select class="form-control" name="id_kategori" required>
                    <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)): ?>
                        <option value="<?= $row_kategori['id']; ?>" <?= ($row_kategori['id'] == $row_wisata['id_kategori']) ? 'selected' : ''; ?>>
                            <?= $row_kategori['nama_kategori']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="current_foto1">Current Foto 1</label>
                <img src="../img/<?= $row_wisata['foto1']; ?>" alt="Current Foto 1" class="img-thumbnail"
                    style="max-width: 100px; height: auto;">
                <input type="text" class="form-control" name="current_foto1" value="<?= $row_wisata['foto1']; ?>"
                    readonly>
            </div>
            <div class="form-group">
                <label for="new_foto1">New Foto 1</label>
                <input type="file" class="form-control-file" name="new_foto1" accept="image/*">
            </div>

            <div class="form-group">
                <label for="current_foto2">Current Foto 2</label>
                <img src="../img/<?= $row_wisata['foto2']; ?>" alt="Current Foto 2" class="img-thumbnail"
                    style="max-width: 100px; height: auto;">
                <input type="text" class="form-control" name="current_foto2" value="<?= $row_wisata['foto2']; ?>"
                    readonly>
            </div>

            <div class="form-group">
                <label for="new_foto2">New Foto 2</label>
                <input type="file" class="form-control-file" name="new_foto2" accept="image/*">
            </div>

            <div class="form-group">
                <label for="current_foto3">Current Foto 3</label>
                <?php
                $currentFoto3 = explode(',', $row_wisata['foto3']);
                foreach ($currentFoto3 as $image) {
                    echo '<img src="../img/' . $image . '" alt="Current Foto 3" class="img-thumbnail" style="max-width: 100px; height: auto;">';
                }
                ?>
                <input type="text" class="form-control" name="current_foto3" value="<?= $row_wisata['foto3']; ?>"
                    readonly>
            </div>

            <div class="form-group">
                <label for="new_foto3">New Foto 3</label>
                <input type="file" class="form-control-file" name="new_foto3[]" accept="image/*" multiple>
                <small class="form-text text-muted">Pilih satu atau lebih file gambar untuk Foto 3.</small>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pending" <?= ($row_wisata['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="accept" <?= ($row_wisata['status'] == 'accept') ? 'selected' : ''; ?>>Accept</option>
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