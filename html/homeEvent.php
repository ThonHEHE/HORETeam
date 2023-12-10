<?php
// index.php

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

$query = "SELECT event.*, kategori_event.nama_kategori 
          FROM event
          LEFT JOIN kategori_event ON event.id_kategori = kategori_event.id";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Tiket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Explore Destination in Yogyakarta</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="homeAdmin.php">Home</a>
                <li class="nav-item">
                    <a class="nav-link" href="homeEvent.php">Your Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Data Event</h2>
        <a href="tambahE.php" class="btn btn-success mb-3">Tambah Event</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal Event</th>
                    <th>Tanggal Selesai</th>
                    <th>Status Waktu</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td><?= $row['lokasi']; ?></td>
                        <td><?= $row['tanggal_event']; ?></td>
                        <td><?= $row['tanggal_selese']; ?></td>
                        <td><?= $row['status_waktu']; ?></td>
                        <td>
                            <img class="img-fluid" src="../img/<?php echo $row['foto']; ?>" alt="<?= $row['nama']; ?>" style="max-width: 100px; height: auto;">
                        </td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <a href="percobaan3.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="hapusE.php?id=<?= $row['id']; ?>" class="btn btn-danger">Hapus</a>
                            <a href="ubah_statusE.php?id=<?= $row['id']; ?>" class="btn btn-primary">Ubah Status</a>
                            <a href="ubah_statusW.php?id=<?= $row['id']; ?>" class="btn btn-primary">Ubah Status Waktu</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
</body>

</html>

<?php
// Tutup koneksi setelah selesai menggunakan
mysqli_close($koneksi);
?>
