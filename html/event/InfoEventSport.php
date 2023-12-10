<?php
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>Event Art</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Pre HEader ***** -->
    <div class="banner">
        <div class="slider">
            <img src="" id="slideImg">
        </div>

        <div class="navbar navbar-expand-lg navbar-light fixed-top bg-dark"
            style="background-color: rgb(217, 217, 217);">
            <div class="container">
                <a class="navbar-brand text-white" href="#page-top">
                    <img src="assets/imgg//logo/jogja-high-resolution-logo-transparent.png" alt="" width="45px"
                        height="50px" class="d-inline-block ">
                    Explore Destination In Yogyakarta
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white" href="../landingPage.html" aria-expanded="false">
                                Home
                            </a>
                            <ul class="dropdown-menu bg-transparent">
                                <li><a class="dropdown-item text-white" href="../aboutUs.html">About us</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-white" href="../contactUs.html">Contact Us</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../news.html">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../event.html">Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../destination.html">Destination</a>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-light" href="../login.html" type="submit">Login</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-heading-shows-events position-relative bg-image-full"
            style="background-image: url(../event/assets/imgg/EventSport/sport.jpeg);">
            <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background-color: rgba(0, 0, 0.6);">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Event Sport</h2>
                        <span>Check out upcoming and past events and be part of us.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="shows-events-tabs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="tabs">
                            <div class="col-lg-12">
                                <div class="heading-tabs">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <ul>
                                                <li><a href='#tabs-1'>Upcoming</a></li>
                                                <li><a href='#tabs-2'>Past</a></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <section class='tabs-content'>
                                    <article id='tabs-1'>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="heading">
                                                    <h2>Upcoming</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="sidebar shadow">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="heading-sidebar">
                                                                <h4>Sort The Upcoming Events By:</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="venues">
                                                                <h6>Place</h6>
                                                                <ul>
                                                                    <li><a href="#Sleman">Sleman</a></li>
                                                                    <li><a href="#Bantul">Bantul</a></li>
                                                                    <li><a href="#Kulon Progo">Kulon Progo</a></li>
                                                                    <li><a href="#Gunung Kidul">Gunung Kidul</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <?php
                                                    // Fetch event data from the database
                                                    $sql = "SELECT * FROM event 
                                                            JOIN kategori_event ON event.id_kategori = kategori_event.id
                                                            WHERE event.status = 'accept' AND event.status_waktu = 'upcoming' AND kategori_event.nama_kategori = 'Sport'";

                                                    $result = $koneksi->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-lg-12">
                                                                <div class="event-item shadow">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="left-content">
                                                                                <h4>
                                                                                    <?php echo $row['nama']; ?>
                                                                                </h4>
                                                                                <p>
                                                                                    <?php echo $row['deskripsi']; ?>
                                                                                </p>
                                                                                <div class="main-dark-button">
                                                                                    <a href="<?php echo $row['detail']; ?>"
                                                                                        target="_blank">Discover More</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="thumb"><br>
                                                                                <img src="../../img/<?php echo $row['foto']; ?>"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="right-content">
                                                                                <ul>
                                                                                    <li><i class="fa fa-calendar"></i>
                                                                                        <h6>
                                                                                            <?php echo $row['tanggal_event'] . ' sampai ' . $row['tanggal_selese']; ?>
                                                                                        </h6>
                                                                                    </li>
                                                                                    <li><i class="fa fa-map-marker"></i>
                                                                                        <h6>
                                                                                            <?php echo $row['lokasi']; ?>
                                                                                        </h6>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }

                                                    // Close connectio
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article id='tabs-2'>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="heading">
                                                    <h2>Past</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="sidebar shadow">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="heading-sidebar">
                                                                <h4>Sort The Upcoming Events By:</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="venues">
                                                                <h6>Place</h6>
                                                                <ul>
                                                                    <li><a href="#">Sleman</a></li>
                                                                    <li><a href="#">Bantul</a></li>
                                                                    <li><a href="#">Kulon Progo</a></li>
                                                                    <li><a href="#">Gunung Kidul</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="row">
                                                <?php
                                                    // Fetch event data from the database
                                                    $sql = "SELECT * FROM event 
                                                            JOIN kategori_event ON event.id_kategori = kategori_event.id
                                                            WHERE event.status = 'accept' AND event.status_waktu = 'past' AND kategori_event.nama_kategori = 'Sport'";

                                                    $result = $koneksi->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-lg-12">
                                                                <div class="event-item shadow">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="left-content">
                                                                                <h4>
                                                                                    <?php echo $row['nama']; ?>
                                                                                </h4>
                                                                                <p>
                                                                                    <?php echo $row['deskripsi']; ?>
                                                                                </p>
                                                                                <div class="main-dark-button">
                                                                                    <a href="<?php echo $row['detail']; ?>"
                                                                                        target="_blank">Discover More</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="thumb"><br>
                                                                                <img src="../../img/<?php echo $row['foto']; ?>"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="right-content">
                                                                                <ul>
                                                                                    <li><i class="fa fa-calendar"></i>
                                                                                        <h6>
                                                                                            <?php echo $row['tanggal_event'] . ' sampai ' . $row['tanggal_selese']; ?>
                                                                                        </h6>
                                                                                    </li>
                                                                                    <li><i class="fa fa-map-marker"></i>
                                                                                        <h6>
                                                                                            <?php echo $row['lokasi']; ?>
                                                                                        </h6>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }

                                                    // Close connectio
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer>
            <div class="col-lg-8">
                <p class="copyright">Copyright © Explore destination in Yogyakarta</p>
            </div>
        </footer>



        <!-- jQuery -->
        <script src="assets/js/jquery-2.1.0.min.js"></script>

        <!-- Bootstrap -->
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Plugins -->
        <script src="assets/js/scrollreveal.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/imgfix.min.js"></script>
        <script src="assets/js/mixitup.js"></script>
        <script src="assets/js/accordions.js"></script>
        <script src="assets/js/owl-carousel.js"></script>

        <!-- Global Init -->
        <script src="assets/js/custom.js"></script>

</body>

</html>