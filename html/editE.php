<?php
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

// Check if the 'id' parameter is set in the URL
if (!isset($_GET['id'])) {
    // Redirect to an appropriate page if 'id' is not provided
    header("Location: homeEvent.php");
    exit();
}

// Get the event ID from the URL
$event_id = $_GET['id'];

// Retrieve the event data based on the provided ID
$query = "SELECT event.*, kategori_event.nama_kategori 
          FROM event
          LEFT JOIN kategori_event ON event.id_kategori = kategori_event.id
          WHERE event.id = $event_id";
$result = mysqli_query($koneksi, $query);

// Check if the event with the provided ID exists
if (!$result || mysqli_num_rows($result) == 0) {
    // Redirect to an appropriate page if the event is not found
    header("Location: homeEvent.php");
    exit();
}

// Fetch event data
$row = mysqli_fetch_assoc($result);

// Fetch categories for the dropdown
$kategori_query = "SELECT * FROM kategori_event";
$kategori_result = mysqli_query($koneksi, $kategori_query);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi = $_POST['lokasi'];
    $tanggal_event = $_POST['tanggal_event'];
    $status = $_POST['status'];
    $id_kategori = $_POST['id_kategori'];

    // Update the event data in the database
    $update_query = "UPDATE event 
                     SET nama='$nama', deskripsi='$deskripsi', lokasi='$lokasi', 
                         tanggal_event='$tanggal_event', status='$status', id_kategori=$id_kategori 
                     WHERE id=$event_id";
    $update_result = mysqli_query($koneksi, $update_query);

    // Check if the update was successful
    if ($update_result) {
        // Redirect to the event list page or display a success message
        header("Location: homeEvent.php");
        exit();
    } else {
        // Handle the case where the update fails (display an error message, log, etc.)
        $error_message = "Update failed. Please try again.";
    }
}

// Close the database connection
mysqli_close($koneksi);
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

        <!-- Display error message if any -->
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= $row['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $row['lokasi']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_event">Tanggal Event:</label>
                <input type="text" class="form-control" id="tanggal_event" name="tanggal_event" value="<?= $row['tanggal_event']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="accept">Accept</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori:</label>
                <select class="form-control" id="id_kategori" name="id_kategori" required>
                    <?php while ($kategori = mysqli_fetch_assoc($kategori_result)) : ?>
                        <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == $row['id_kategori']) ? 'selected' : ''; ?>>
                            <?= $kategori['nama_kategori']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
</body>

</html>
