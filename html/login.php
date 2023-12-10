<?php
session_start();
include "koneksi.php";

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
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

        /* Mengubah warna background navbar */
        .navbar {
            background-color: #d9d9d9;
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
            margin: 160px auto 0;
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
            color: white; /* Change text color to white */
            text-align: justify; /* Justify text */
        }
    
        .content label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .content h2 {
            color: white; /* Change heading color to white */
            text-align: center; /* Center align heading */
        }
    
        /* Add these styles for the Login button */
        .content button {
            display: block;
            margin: 0 auto; /* Center align the button */
            width: 100%; /* Set the width to 100% */
        }
        
    </style>

</head>

<body onload="slider()">
<?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    
        if (mysqli_num_rows($query) != 0) {
            $row = mysqli_fetch_assoc($query);
    
            // Set user details in the session
            $_SESSION['user'] = $row;
            $_SESSION['role'] = $row['role'];
    
            if ($row['role'] == 'admin') {
                header("Location: homeAdmin.php");
                exit();
            } elseif ($row['role'] == 'user') {
                header("Location: landingPageLogin.php");
                exit();
            }
        } else {
            echo '<script>alert("Username/password salah.");</script>';
        }
    }
    ?>
    <div class="banner">
        <div class="slider">
            <img src="../img/background/slide1.JPEG" id="slideImg">
        </div>
        <div class="overlay">

            <div class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top"
                style="background-color: rgb(217, 217, 217);">
                <div class="container">
                    <a class="navbar-brand text-white" href="#page-top">
                        <img src="../img/logo/jogja-high-resolution-logo-transparent.png" alt="" width="45px" height="50px"
                            class="d-inline-block ">
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
                                <a class="nav-link text-white" href="landingPage.html" aria-expanded="false">
                                    Home
                                </a>
                                <ul class="dropdown-menu bg-transparent">
                                    <li><a class="dropdown-item text-white" href="aboutUs.html">About us</a></li>
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
                                <a class="nav-link text-white active" href="destination.html">Destination</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-light" type="submit" href="login.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="row ">
                    <div class="col-md-6 offset-md-3 mt-5 bg-light bg-opacity-10 border border-light-subtle shadow" style="border-radius: 20px;">
                        <br><h2>Sign In</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" >
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" >
                            </div>
                            <button type="submit" class="btn btn-success" name="loginbtn">Login</button>
            
                        </form>
                        <a class="text-light" href="signup.php">Sign Up?</a><br><br>
                    </div>
                </div>
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