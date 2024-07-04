<?php
session_start();
if (empty($_SESSION['username'])) {
    // Redirect ke halaman login jika tidak ada session username
    header("Location: index.php");
    exit;
}

// Koneksi ke database (sesuaikan dengan informasi database Anda)
include 'koneksi.php';

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Query untuk mengambil jumlah catatan dari database
$sql = "SELECT COUNT(*) AS total_catatan FROM catatan WHERE user_id = $user_id";
$result = $conn->query($sql);

$total_catatan = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_catatan = $row['total_catatan'];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User - CaPer</title>

    <!-- cdn fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Tambahkan CSS berikut untuk membuat sidebar tetap dan nempel ke konten utama -->
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            overflow-y: auto;
            width: 225px;
            /* Lebar sidebar tetap */
        }

        .content-wrapper {
            margin-left: 225px;
            /* Sesuaikan dengan lebar sidebar */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            margin-top: 70px;
            /* Sesuaikan dengan tinggi navbar */
            padding: 20px;
        }

        footer {
            flex-shrink: 0;
        }

        .topbar {
            position: fixed;
            top: 0;
            left: 225px;
            /* Sesuaikan dengan lebar sidebar */
            width: calc(100% - 225px);
            /* Sesuaikan dengan lebar sidebar */
            z-index: 1000;
        }

        /* Tambahkan gaya untuk item aktif di sidebar */
        .nav-item.active {
            background-color: #4e73df;
        }

        .nav-item.active .nav-link,
        .nav-item.active .nav-link i {
            color: #fff;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CAPER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item" id="dashboard">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- Nav Item - Buat Catatan -->
            <li class="nav-item" id="buat_catatan">
                <a class="nav-link" href="?url=buat_catatan">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Buat Catatan Anda</span></a>
            </li>

            <!-- Nav Item - Catatan Perjalanan -->
            <li class="nav-item" id="catatan_perjalanan">
                <a class="nav-link" href="?url=catatan_perjalanan">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Catatan Perjalanan Anda</span></a>
            </li>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="#" id="logoutBtn">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column content-wrapper">

            <!-- Main Content -->
            <div id="content" class="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <h3 class="sidebar-brand-text mt-2 ml-2">CaPer - Catatan Perjalanan</h3>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php
                    $url = @$_GET['url'];
                    $page = @$_GET['page'];

                    switch ($url) {
                        case 'buat_catatan':
                            include "buat_catatan.php";
                            break;

                        case 'catatan_perjalanan':
                            include "catatan_perjalanan.php";
                            break;

                        case 'edit_catatan':
                            include "edit_catatan.php";
                            break;

                        default:
                            // Halaman default adalah dashboard
                            echo '
                                <h1 class="mb-4 text-gray-800">Selamat datang ' . $_SESSION['username'] . '👋</h1>
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Informasi Pengguna</h6>
                                            </div>
                                            <div class="card-body">
                                                <p>Username: ' . $_SESSION['username'] . '</p>
                                                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Jumlah Catatan Anda</h6>
                                            </div>
                                            <div class="card-body">
                                                <p>Jumlah Catatan: ' . $total_catatan . '</p> <!-- Ambil dari database -->
                                                <!-- Anda dapat menggunakan AJAX untuk mengambil data jumlah catatan -->
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            break;
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-auto">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CaPer - Catatan Perjalanan 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- sweetalert -->
    <script src="dist/sweetalert2.all.min.js"></script>

    <!-- buat alert warning pertanyaan ya atau tidak sebelum logout -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('logoutBtn').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin keluar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0275d8',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'logikalogout.php';
                    }
                });
            });
        });

        // Tambahkan JavaScript untuk menambahkan kelas 'active' pada item sidebar yang dipilih
        window.addEventListener('DOMContentLoaded', (event) => {
            var url = new URL(window.location.href);
            var param = url.searchParams.get("url");
            if (param) {
                document.getElementById(param).classList.add('active');
            } else {
                document.getElementById('dashboard').classList.add('active');
            }
        });
    </script>

</body>

</html>