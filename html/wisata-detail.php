<?php
include 'koneksi.php';

$nama = $_GET['nama'];

$query = "SELECT wisata.*, kategori_wisata.nama_kategori 
          FROM wisata 
          LEFT JOIN kategori_wisata ON wisata.id_kategori = kategori_wisata.id 
          WHERE nama = '$nama'";

$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result)


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $row['nama'] ?></title>
    <link rel="icon" type="image/x-icon" href="../../../img/logo/jogja-high-resolution-logo-transparent.png" />
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="destination/css/styles.css" rel="stylesheet" />
    <link href="destination/css/styles_sidebar.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>



<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!"><img src="../img/logo/jogja-high-resolution-logo-transparent.png"
                    alt="" width="65px" height="70px" class="d-inline-block ">Explore Destination in Yogyakarta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                        <a class="nav-link active" aria-current="page" href="landingPage.html">Home</a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">About us</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="news.html">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="event.html">Event</a></li>
                    <li class="nav-item"><a class="nav-link" href="destination.html">Destination</a></li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="login.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-image-full position-relative "
        style="background-image: url('../img/<?php echo $row['foto2'] ?>'); height:400px; ">
        <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="text-center my-5 text-white position-relative">
            <h1 class="text-white fs-1 fw-bolder" style="font-size: 4em;"><?php echo $row['nama'] ?></h1>
            <p class="text-white-50 mb-0"><?php echo $row['nama_kategori'] ?> Destination</p>
        </div>

    </header>
    <!-- Content section-->
    <section class="py-5" style="background-color: #F5F8FB; ">
        <div class="container my-n5 mx-auto w-75 position-relative" style="margin-top: -7%;">

            <div class="row justify-content-center bg-white">

            <div id="myCarousel" class="owl-carousel  owl-theme pt-3 w-75">
            <?php
            $foto3 = explode(',', $row['foto3']);
    
            foreach ($foto3 as $image) {
            echo '<div class="item"><img src="../img/' . $image . '" alt=""></div>';
            }
            ?>
            </div>

                <div id="layoutSidenav">

                    <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                            <div class="sb-sidenav-menu bg-white">
                                <div class="nav">
                                    <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                                    <a class="nav-link mt-2" href="" id="menuDeskripsi">
                                        <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor" class="bi bi-card-text"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                                <path
                                                    d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                            </svg></div>
                                        Deskripsi
                                    </a>

                                    <a class="nav-link" href="#" id="menuTiket">
                                        <div class="sb-nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-ticket-perforated-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4-1v1h1v-1zm1 3v-1H4v1zm7 0v-1h-1v1zm-1-2h1v-1h-1zm-6 3H4v1h1zm7 1v-1h-1v1zm-7 1H4v1h1zm7 1v-1h-1v1zm-8 1v1h1v-1zm7 1h1v-1h-1z" />
                                            </svg>
                                        </div>
                                        Harga Tiket
                                    </a>

                                    <a class="nav-link" href="" id="menuJam">
                                        <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor" class="bi bi-clock-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                            </svg></div>
                                        Jam Operasional
                                    </a>
                                    <a class="nav-link" href="" id="menuFasilitas">
                                        <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor" class="bi bi-tv-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5M2 2h12s2 0 2 2v6s0 2-2 2H2s-2 0-2-2V4s0-2 2-2" />
                                            </svg></div>
                                        Fasilitas
                                    </a>
                                    <a class="nav-link" id="menuLokasi" href="">
                                        <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor" class="bi bi-geo-alt-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                            </svg></div>
                                        Lokasi
                                    </a>
                        </nav>
                    </div>
                    <div id="layoutSidenav_content">
                        <main>
                            <div class="container-fluid px-4">
                                <div class="card mb-4 mt-2" id="deskripsiContent">
                                    <h1 class="mt-2 mb-0 ms-3">Deskripsi</h1>
                                    <div class="card-body">
                                        <p class="mb-0">
                                        <?php echo $row['deskripsi'] ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="card mb-4 mt-2" id="kontenTiket" ">
                                    <h1 class=" mt-2 mb-0 ms-3">Harga Tiket</h1>
                                    <div class=" card-body">
                                        <p class="mb-0">
                                            Berikut adalah informasi harga tiket di <?php echo $row['nama'] ?>:
                                        </p>
                                        <p class="mb-0">
                                        <?php echo $row['harga_tiket'] ?>
                                        </p> 
                                    </div>
                                </div>
                                <div class="card mb-4 mt-2" id="kontenJam" ">
                                    <h1 class=" mt-2 mb-0 ms-3">Jam Operasional</h1>
                                    <div class=" card-body">
                                        <p class="mb-0">
                                            Berikut adalah informasi Jam Operasional di <?php echo $row['nama'] ?>:
                                        </p>
                                        <p class="mb-0">
                                        <?php echo $row['jam_operasional'] ?>
                                        </p> 
                                    </div>
                                </div>
                                <div class="card mb-4 mt-2" id="kontenFasilitas" ">
                                    <h1 class=" mt-2 mb-0 ms-3">Fasilitas</h1>
                                    <div class=" card-body">
                                        <p class="mb-0">
                                            Fasilitas yang tersedia di antaranya:
                                        </p>
                                        <p class="mb-0">
                                        <?php echo $row['fasilitas'] ?>
                                        </p> 
                                    </div>
                                </div>
                                <div class="card mb-4 mt-2" id="kontenLokasi" ">
                                    <h1 class=" mt-2 mb-0 ms-3">Lokasi</h1>
                                    <div class=" card-body">
                                        <iframe
                                            src="<?php echo $row['lokasi'] ?>"
                                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>

                                </div>
                            </div>

                    </div>
                </div>
            </div>

        </div>
        </main>


        </div>
        </div>
    </section>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Explore Destination in Yogyakarta</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- <script src="js/scripts.js"></script> -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="jquery.min.js"></script>
    <script src="owlcarousel/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myCarousel').owlCarousel({
                items: 3, // Number of cards shown in each slide
                loop: true, // Continuously loop the carousel
                margin: 20, // Space between cards
                nav: false, // Show navigation buttons
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true,
                navText: [
                    "<i class='fas fa-chevron-left'></i>",
                    "<i class='fas fa-chevron-right'></i>",
                ], // Custom navigation icons
                responsive: {
                    0: {
                        items: 1, // Number of cards shown in the carousel for smaller screens
                    },
                    768: {
                        items: 1, // Number of cards shown in the carousel for medium screens
                    },
                    992: {
                        items: 3, // Number of cards shown in the carousel for large screens
                    },
                },
            });
            // Fungsi untuk menampilkan konten sesuai dengan menu sidebar yang diklik



        });
    </script>

    <script>
        $(document).ready(function () {
            // Event listener untuk setiap menu sidebar
            $('#menuDeskripsi').on('click', function (e) {
                e.preventDefault(); // Menghentikan perilaku default tautan
                showContent('#deskripsiContent');
            });

            // Event listener untuk menu Harga Tiket
            $('#menuTiket').on('click', function (e) {
                e.preventDefault(); // Menghentikan perilaku default tautan
                showContent('#kontenTiket');
            });

            // Event listener untuk menu Jam Operasional
            $('#menuJam').on('click', function (e) {
                e.preventDefault(); // Menghentikan perilaku default tautan
                showContent('#kontenJam');
            });

            // Event listener untuk menu Fsailitas
            $('#menuFasilitas').on('click', function (e) {
                e.preventDefault(); // Menghentikan perilaku default tautan
                showContent('#kontenFasilitas');
            });

            // Event listener untuk menu Lokasi
            $('#menuLokasi').on('click', function (e) {
                e.preventDefault(); // Menghentikan perilaku default tautan
                showContent('#kontenLokasi');
            });

            // Secara default, tampilkan konten deskripsi
            showContent('#deskripsiContent');

            // Fungsi untuk menampilkan konten sesuai dengan menu sidebar yang diklik
            function showContent(contentId) {
                // Semua konten di-hide menggunakan class d-none
                $('.card').addClass('d-none');
                // Konten dengan id yang sesuai ditampilkan
                $(contentId).removeClass('d-none');
            }
        });
    </script>






    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts_sidebar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>


</body>

</html>