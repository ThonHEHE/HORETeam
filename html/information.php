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
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
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

    $query = "INSERT INTO wisata (nama, deskripsi, harga_tiket, jam_operasional, fasilitas, lokasi, id_kategori, foto) VALUES ('$nama', '$deskripsi', '$harga_tiket', '$jam_operasional', '$fasilitas', '$lokasi', $id_kategori, '$foto')";

    if (mysqli_query($koneksi, $query)) {
        header('Location: landingPageLogin.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}

$query_kategori = "SELECT * FROM kategori_wisata";
$result_kategori = mysqli_query($koneksi, $query_kategori);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap" rel="stylesheet">
    <title>Information</title>
    <style>
        /* Menghilangkan icon dropdown */
        .navbar .nav-item.dropdown>a::after {
            display: none;
        }

        /* Menampilkan dropdown otomatis saat kursor berada di atasnya */
        .navbar .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Menyesuaikan tampilan item dropdown yang aktif */
        .navbar .nav-item.dropdown .dropdown-menu a.active {
            font-weight: bold;
            color: black;
            background-color: transparent;
        }

        .navbar .nav-item.dropdown .dropdown-menu a {
            color: black;
            background-color: transparent;
        }

        /* Menambahkan border pada dropdown menu */
        .navbar .nav-item.dropdown .dropdown-menu {
            border: 1px solid #ddd;
            /* Sesuaikan dengan warna dan ketebalan border yang diinginkan */
            border-radius: 0;
            /* Untuk memastikan border tidak memiliki sudut melengkung, sesuaikan sesuai kebutuhan */
        }

        /* Menambahkan border pada dropdown menu */
        .navbar .nav-item.dropdown .dropdown-divider {
            border: 1px solid #ddd;
            /* Sesuaikan dengan warna dan ketebalan border yang diinginkan */
            border-radius: 0;
            /* Untuk memastikan border tidak memiliki sudut melengkung, sesuaikan sesuai kebutuhan */
        }


        /* Mengubah warna background navbar */
        .navbar {
            background-color: #d9d9d9;
        }

        .navbar-brand {
            letter-spacing: 2px;
        }

        @media (max-width: 991px) {
            .navbar {
                background-color: rgb(217, 217, 217);


            }

            .navbar-toggler-icon {
                background-color: #fff;
                /* Ganti warna garis hamburger sesuai kebutuhan */
            }

            .navbar-collapse {
                border-radius: 10px;
                border: 1px solid #fff;
                background-color: black;
            }

            .navbar-brand {
                letter-spacing: 0px;
            }

        }

        .navbar-collapse {
            padding: 1rem;
        }


        .background-clip {
            width: 100%;
            height: auto;
        }


        body {}

        .video h2,
        h3 {
            text-align: center;
        }


        .banner {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .slider {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
        }

        #slideImg {
            width: 100%;
            height: 100%;
            animation: zoom 3s linear infinite;
        }

        @keyframes zoom {
            0% {
                transform: scale(1.3);
            }

            15% {
                transform: scale(1);
            }

            85% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.3);
            }
        }

        .overlay {
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
            position: absolute;
            top: 0;
        }

        .navbar {
            background-color: rgba(217, 217, 217, 1);
            transition: background-color 0.3s ease;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .content {
            width: 60%;
            margin: 120px auto 0;
            text-align: center;
        }

        .footer {
            background-color: rgba(217, 217, 217, 0.5);
            transition: background-color 0.3s ease;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .dark-overlay {
            background: rgba(0, 0, 0, 0.3);
            /* Adjust the opacity as needed */
        }

        .content form {
            color: white;
            /* Change text color to white */
            text-align: justify;
            /* Justify text */
        }

        .content label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .content h2 {
            color: white;
            /* Change heading color to white */
            text-align: center;
            /* Center align heading */
        }

        /* Add these styles for the Login button */
        .content a {
            display: block;
            margin: 0 auto;
            /* Center align the button */
            width: 100%;
            /* Set the width to 100% */
        }
    </style>

</head>

<body onload="slider()">







    <div class="banner">
        <div class="slider">
            <img src="../img/background/slide1.JPEG" id="slideImg">
        </div>
        <div class="overlay">

            <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top"
                style="background-color: rgb(217, 217, 217);">
                <div class="container">
                    <a class="navbar-brand text-white" href="#page-top" style="font-family: 'inter'; ">
                        <img src="../img/logo/jogja-high-resolution-logo-transparent.png" alt="" width="65px"
                            height="70px" class="d-inline-block ">
                        Explore Destination In Yogyakarta
                    </a>
                    <button class="navbar-toggler navbar-toggler-right bg-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end bg" id="mainNav">
                        <ul class="navbar-nav" style="font-family: 'inter';">
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white active" href="landingPage.html" aria-expanded="false">
                                    Home
                                </a>
                                <ul class="dropdown-menu bg-transparent">
                                    <li><a class="dropdown-item text-white active" href="aboutUs.html">About us</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-white" href="contactUs.html">Contact Us</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="news.html">News</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="event.html">Event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="destination.html">Destination</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-person-circle text-white" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                                            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li> -->
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="row gx-5">
                    <div class="col mt-5 bg-light bg-opacity-10 border border-light-subtle shadow mx-3"
                        style="border-radius: 20px;">
                        <br>
                        <h2>Information Destination Available</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Destination Name</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control" name="id_kategori" required>
                                    <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)): ?>
                                        <option value="<?= $row_kategori['id']; ?>">
                                            <?= $row_kategori['nama_kategori']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga_tiket" class="form-label">Price Ticket</label>
                                <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" required>
                            </div>
                            <div class="mb-3">
                                <label for="operational" class="form-label">Operational Hour</label>
                                <input type="operational" class="form-control" id="jam_operasional"
                                    name="jam_operasional" required>
                            </div>
                    </div>
                    <div class="col mt-5 bg-light bg-opacity-10 border border-light-subtle shadow mx-3"
                        style="border-radius: 20px;">
                        <br>
                        <div class="mb-3">
                            <label for="name" class="form-label text-white text-start">Location</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label text-white text-start">facility</label>
                            <input type="text" class="form-control" id="fasilitas" name="fasilitas" required>
                        </div>
                        <div class="mb-3">
                            <label for="Description" class="form-label text-white text-start">Description</label>
                            <textarea class="form-control" placeholder="" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label text-white text-start">Input Picture</label>
                            <input class="form-control" type="file" id="input" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class=" border-light-subtle shadow mx-3" style="border-radius: 20px;">
                        <br>
                        <button type="submit" class="btn btn-success">Submit here</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- <main>
        <div class="video">
            <audio autoplay="" loop="">
                <source src="vid-jogja.mp3" type="audio/mp3">
            </audio>

            <video autoplay="" loop="" muted="" class=" top-0 start-0 w-100 h-100 dark-overlay"
                style="object-fit: cover; z-index: -1;">
                <source src="horejogja.mp4" type="video/mp4">
            </video>


            <br><br>
            <h2>ABOUT US</h2><br>
            <h3>Mahasiswa semester 3 di Universitas Islam Indonesia</h3>
            <h2>HORE TEAM</h2>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>

        <div class="aboutUs">


        </div>
    </main> -->


        <footer class="footer py-2 text-center text-body-secondary bg-transparent"
            style="background-color: rgba(217, 217, 217, 0.5);">
            <p class="text-white">Copyright © Explore destination in Yogyakarta</p>
            <!-- <p class="mb-0">
            <a href="#">Back to top</a>
        </p> -->
        </footer>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>

        <script>
            window.addEventListener('scroll', function () {
                var navbar = document.querySelector('.navbar');
                var footer = document.querySelector('.footer');

                var top = window.scrollY;
                var totalHeight = document.body.scrollHeight - window.innerHeight;
                var scrollPercentage = (top / totalHeight) * 100;

                if (scrollPercentage < 10) {
                    navbar.style.backgroundColor = 'rgba(217, 217, 217, 1)';
                    footer.style.backgroundColor = 'rgba(217, 217, 217, 0.5)';
                } else if (scrollPercentage > 90) {
                    navbar.style.backgroundColor = 'rgba(217, 217, 217, 0.5)';
                    footer.style.backgroundColor = 'rgba(217, 217, 217, 1)';
                }
            });
        </script>

        <script>
            var slideImg = document.getElementById("slideImg");

            var images = new Array(
                "../img/background/slide1.JPEG",
                "../img/background/slide2.JPEG",
                "../img/background/slide3.JPEG",
                "../img/background/slide4.PNG"
            );

            var len = images.length;
            var i = 0;

            function slider() {
                if (i > len - 1) {
                    i = 0;
                }
                slideImg.src = images[i];
                i++;
                setTimeout('slider()', 3000);
            }
        </script>


        <!-- Code injected by live-server -->
        <script>
            // <![CDATA[  <-- For SVG support
            if ('WebSocket' in window) {
                (function () {
                    function refreshCSS() {
                        var sheets = [].slice.call(document.getElementsByTagName("link"));
                        var head = document.getElementsByTagName("head")[0];
                        for (var i = 0; i < sheets.length; ++i) {
                            var elem = sheets[i];
                            var parent = elem.parentElement || head;
                            parent.removeChild(elem);
                            var rel = elem.rel;
                            if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                                "stylesheet") {
                                var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                                elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (
                                    new Date()
                                        .valueOf());
                            }
                            parent.appendChild(elem);
                        }
                    }
                    var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                    var address = protocol + window.location.host + window.location.pathname + '/ws';
                    var socket = new WebSocket(address);
                    socket.onmessage = function (msg) {
                        if (msg.data == 'reload') window.location.reload();
                        else if (msg.data == 'refreshcss') refreshCSS();
                    };
                    if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                        console.log('Live reload enabled.');
                        sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                    }
                })();
            } else {
                console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
            }
            // ]]>
        </script>


</body>

</html>