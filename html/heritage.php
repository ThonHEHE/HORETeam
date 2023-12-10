<?php
include 'koneksi.php';

$sql = "SELECT w.foto1, w.nama
        FROM wisata w
        INNER JOIN kategori_wisata k ON w.id_kategori = k.id
        WHERE k.nama_kategori = 'heritage' AND w.status = 'accept'";
$result = $koneksi->query($sql);

$koneksi->close();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo/jogja-high-resolution-logo-transparent.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap" rel="stylesheet">
    <title>Heritage</title>
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
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 4;
            letter-spacing: 1px;
            /* Ensure the navbar is above the video overlay */
        }

        .navbar-brand {
            letter-spacing: 2px;
        }

        .navbar-collapse {
            padding: 1rem;
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

        .background-clip {
            width: 100%;
            height: auto;
        }


        body {

            background-color: black;
        }

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
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6));
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
            margin: 95px auto 0;
            text-align: center;
            position: relative;
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

        .card-img-top {
            height: 250px;
            /* Adjust the height as needed */
            object-fit: cover;
            /* This property ensures that the image covers the entire space even if its aspect ratio is different */
        }

        .card {
            /* Optional: Add a fixed height to the cards for consistency */
            height: 400px;
            /* Adjust the height as needed */
        }
    </style>

</head>

<body onload="slider()">
    <main>
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
                        <button class="navbar-toggler navbar-toggler-right bg-light" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end bg" id="mainNav">
                            <ul class="navbar-nav" style="font-family: 'inter';">
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-white active" href="landingPage.html">Home</a>

                                    <ul class="dropdown-menu bg-transparent">
                                        <li><a class="dropdown-item text-white active">About us</a></li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-white" href="contactUs.html">Contact Us</a>
                                        </li>
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
                                <li class="nav-item">
                                    <a class="btn btn-outline-light" href="login.php">Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        $count = 0;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($count % 8 == 0) {
                                    // Start a new carousel slide
                                    ?>
                                    <div class="carousel-item<?= ($count == 0) ? ' active' : '' ?>">
                                        <div class="content">
                                            <div class="row">
                                            <?php }

                                ?>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="card h-100 bg-transparent border-0">
                                                    <img src="../img/<?= $row['foto1'] ?>" class="card-img-top img-fluid"
                                                        alt="<?= $row['nama'] ?>">
                                                    <div class="card-body">
                                                        <div class="d-grid gap-2">
                                                            <a href="wisata-detail.php?nama=<?php echo $row['nama'];?>" class="btn btn-outline-light"
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                <?= $row['nama'] ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $count++;

                                            if ($count % 8 == 0) {
                                                // End the current carousel slide
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                            }

                            // Close the last carousel slide if the total number of items is not a multiple of 8
                            if ($count % 8 != 0) {
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>

        </div>
        </div>
    </main>




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
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
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