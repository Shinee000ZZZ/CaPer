<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaPer - Catatan Perjalanan</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/stylephp.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="icon" href="favicon/favicon.ico">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .heading {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 24px;
        }

        .paragraph {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 16px;
        }

        #tombols {
            background-color: white;
            color: #0d6efd;
            border: 2px solid #0d6efd;
            transition: background-color 0.4s, color 0.4s;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        #tombols::before {
            content: "";
            background-color: #0d6efd;
            position: absolute;
            top: 0;
            left: 50%;
            width: 300%;
            height: 300%;
            transition: all 0.5s;
            z-index: -1;
            transform: translateX(50%) translateY(-75%) rotate(45deg);
        }

        #tombols:hover::before {
            transform: translateX(-50%) translateY(-35%) rotate(45deg);
        }

        #tombols:hover {
            color: white;
        }

        #tombols span {
            position: relative;
            color: #fff;
            z-index: 1000;
        }

        .navbar-nav .nav-link {
            position: relative;
            display: inline-block;
        }

        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            display: block;
            height: 2px;
            width: 0;
            color: #0d6efd;
            background: #0d6efd;
            transition: width 0.4s;
            bottom: 3.5px;
            left: 7.5px;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
            color: #0d6efd;
        }

        .lds-dual-ring {
            /* change color here */
            color: #0d6efd
        }

        .lds-dual-ring,
        .lds-dual-ring:after {
            box-sizing: border-box;
        }

        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6.4px solid currentColor;
            border-color: currentColor transparent currentColor transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .services {
            padding-top: 130px;
            position: relative;
        }

        #gedein-jir {
            font-size: 35px;
        }

        .services .section-heading p {
            margin-top: 10px;
            margin: auto;
        }

        .services .container-fluid {
            padding-left: 65px;
            padding-right: 65px;
        }

        .services:after {
            content: '';
            background-image: url(assets/images/services-left-dec.png);
            background-repeat: no-repeat;
            position: absolute;
            left: 0;
            bottom: -200px;
            width: 261px;
            height: 368px;
            z-index: -2;
        }

        .services:before {
            content: '';
            background-image: url(assets/images/services-right-dec.png);
            background-repeat: no-repeat;
            position: absolute;
            right: 0;
            top: 0;
            width: 1136px;
            height: 244px;
            z-index: 0;
        }

        .services .section-heading {
            text-align: center;
            margin-bottom: 80px;
        }

        .services .section-heading .line-dec {
            margin: 0 auto;
        }

        .service-item {
            position: relative;
            z-index: 1;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
            border-top-right-radius: 50px;
            width: 300px;
            height: auto;
            margin: auto;
            transition: all .3s;
        }

        .service-item .icon {
            margin-left: 0px;
            margin-bottom: 30px;
            background-repeat: no-repeat;
            width: 50px;
            height: 50px;
            transition: all .3s;
        }

        .service-item h4 {
            transition: all .3s;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .service-item p {
            transition: all .3s;
            font-size: 14px;
            margin: auto;
        }



        .service-item:hover h4,
        .service-item:hover p,
        .service-item:hover .text-button a {
            color: #fff;
        }

        .first-service .icon {
            background-image: url(assets/images/01.png);
        }

        .first-service:hover .icon {
            background-image: url(assets/images/01-hover.png);
        }

        .second-service .icon {
            background-image: url(assets/images/02.png);
        }

        .second-service:hover .icon {
            background-image: url(assets/images/02-hover.png);
        }


        .third-service .icon {
            background-image: url(assets/images/03.png);
        }

        .third-service:hover .icon {
            background-image: url(assets/images/03-hover.png);
        }

        .fourth-service .icon {
            background-image: url(assets/images/04.png);
        }

        .fourth-service:hover .icon {
            background-image: url(assets/images/04-hover.png);
        }

        .fifth-service .icon {
            background-image: url(assets/images/05.png);
        }

        .fifth-service:hover .icon {
            background-image: url(assets/images/05-hover.png);
        }

        .sixth-service .icon {
            background-image: url(assets/images/06.png);
        }

        .sixth-service:hover .icon {
            background-image: url(assets/images/06-hover.png);
        }

        .service-item:hover {
            background-image: url(assets/images/service-bg.jpg);
            background-position: right top;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div class="lds-dual-ring"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand ml-5 " href="#" id="navbarBrand">CaPer - Catatan Perjalanan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-5" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary mr-5" href="#" data-toggle="modal" data-target="#loginModal" id="tombols">
                            <i class="fas fa-user"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5" id="hero">
        <div class="row align-items-center">
            <div class="col-md-6" id="heroText" data-aos="fade-right" data-aos-duration="900">
                <h1 class="text-start" id="judulHero">Selamat datang di <span id="typedText">CaPer</span></h1>
                <p class="lead text-start">Dokumentasikan setiap momen perjalanan Anda dengan mudah dan menyenangkan! </p>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#registerModal" id="tombols">Get Started</a>
            </div>
            <div class="col-md-6 text-center img-container" data-aos="fade-left" data-aos-duration="900">
                <img src="assets/Frame 2.png" alt="Travel Image" class="img-fluid hero-img">
            </div>
        </div>
    </div>

    <!-- services -->
    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-heading wow fadeInDown" data-wow-duration="2s" data-wow-delay="2s">
                        <h4 id="gedein-jir">Amazing <em style="color: #0d6efd;">Services &amp; Features</em> for you</h4>
                        <img src="assets/images/heading-line-dec.png" alt="">
                        <p>Berikut adalah keunggulan dan layanan dari aplikasi Kami yang mungkin kamu cari: fitur canggih, layanan terbaik, mudah digunakan, layanan pelanggan responsif, dan kompatibilitas platform yang luas.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-md-6 mb-4 mr-5" data-aos="fade-right" data-aos-duration="900">
                    <div class="service-item first-service">
                        <div class="icon"></div>
                        <h4>Digitalisasikan Catatan Anda</h4>
                        <p>Simpan kenangan perjalanan dengan aplikasi pencatat lokasi otomatis.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="fa fa-arrow-right mt-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4 mr-5" data-aos="fade-down" data-aos-duration="900">
                    <div class="service-item second-service">
                        <div class="icon"></div>
                        <h4>Dokumentasikan Liburanmu</h4>
                        <p>Tangkap kenangan liburanmu dengan ringkas dan informatif di sini.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="fa fa-arrow-right mt-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4 mr-5" data-aos="fade-left" data-aos-duration="900">
                    <div class="service-item third-service">
                        <div class="icon"></div>
                        <h4>Kapan saja &amp; Dimana saja</h4>
                        <p>Fleksibilitas waktu untuk perencanaan liburan yang mudah dan sesuai.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="fa fa-arrow-right mt-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4 mr-5" data-aos="fade-right" data-aos-duration="900">
                    <div class="service-item fourth-service">
                        <div class="icon"></div>
                        <h4>24/7 Bantuan &amp; Dukungan </h4>
                        <p>Bantuan dan dukungan sepanjang waktu untuk kebutuhan Anda kapan saja.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="fa fa-arrow-right mt-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4 mr-5" data-aos="fade-up" data-aos-duration="900">
                    <div class="service-item fifth-service">
                        <div class="icon"></div>
                        <h4>Pengkoordinatan yang Tepat</h4>
                        <p>Koordinat yang Memandu Anda Menuju Pengalaman Baru yang Menyenangkan.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="fa fa-arrow-right mt-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4 mr-5 mb-5" data-aos="fade-left" data-aos-duration="900">
                    <div class="service-item sixth-service">
                        <div class="icon"></div>
                        <h4>Catatan yang Bersifat Pribadi</h4>
                        <p>Kami mendesain fitur catatan yang aman dan pribadi demi kenyamanan Anda.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="fa fa-arrow-right mt-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="tombols">Login</button>
                    </form>
                    <div class="mt-3">
                        <span>Tidak punya akun? <a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Daftar disini</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="form-group">
                            <label for="registerUsername">Username</label>
                            <input type="text" class="form-control" id="registerUsername" name="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="tombols">Register</button>
                    </form>
                    <div class="mt-3">
                        <span>Sudah punya akun? <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- footer -->

    <footer class="text-center text-white mt-5" style="background-color: #f1f1f1;" id="contact">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="social-icon mb-3 text-">
                <h4 class="text-dark mb-2 mt-1">Contact Us</h4>
                <!-- Twitter -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://x.com/OkeShinee" role="button" data-mdb-ripple-color="dark" data-aos="fade-right" data-aos-duration="900"><i class="fab fa-twitter" style="color: black;" onmouseover="this.style.color='#0d6efd';" onmouseleave="this.style.color='black';"></i></a>

                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://instagram.com/kesaltunan" role="button" data-mdb-ripple-color="dark" data-aos="fade-right" data-aos-duration="900"><i class="fab fa-instagram" style="color: black;" onmouseover="this.style.color='#0d6efd';" onmouseleave="this.style.color='black';"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://tiktok.com/@oshitergantungfyp" role="button" data-mdb-ripple-color="dark" data-aos="fade-left" data-aos-duration="900"><i class="fab fa-tiktok" style="color: black;" onmouseover="this.style.color='#0d6efd';" onmouseleave="this.style.color='black';"></i></a>
                <!-- Github -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://wa.me/089502632801" role="button" data-mdb-ripple-color="dark" data-aos="fade-left" data-aos-duration="900"><i class="fab fa-whatsapp" style="color: black;" onmouseover="this.style.color='#0d6efd';" onmouseleave="this.style.color='black';"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright -
            <a class="text-dark" href="#hero">CaPer - Sultan Syaeful Millah</a>
        </div>
        <!-- Copyright -->
    </footer>



    <!-- Scroll to Top Button -->
    <div class="scrollToTopContainer" id="scrollToTopContainer">
        <button class="scrollToTop" id="scrollToTop">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- sweetalert -->
    <script src="dist/sweetalert2.all.min.js"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script>
        // AOS INIT 
        AOS.init();

        // preloader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('preloader').style.display = 'none';
            }, 200); // Delay time in milliseconds (2000ms = 2s)
        });


        // Scroll to Top Functionality
        const scrollToTopButton = document.getElementById('scrollToTopContainer');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollToTopButton.classList.add('show');
            } else {
                scrollToTopButton.classList.remove('show');
            }
        });

        document.getElementById('scrollToTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            fetch('register.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = data.redirect; // Mengarahkan ke halaman admin
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan, coba lagi nanti.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
</body>

</html>