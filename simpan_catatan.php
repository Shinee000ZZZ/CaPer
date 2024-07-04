<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Peroleh ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$foto = $_FILES['foto']['name'];
$tmp_name = $_FILES['foto']['tmp_name'];

// Pastikan direktori tujuan untuk upload ada dan sesuai dengan konfigurasi Anda
$upload_dir = 'path/to/upload/directory/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

include 'koneksi.php';

// Gunakan prepared statement untuk mencegah SQL Injection
$stmt = mysqli_prepare($conn, "INSERT INTO catatan (user_id, tanggal, waktu, deskripsi, lokasi, foto) VALUES (?, ?, ?, ?, ?, ?)");

// Bind parameters
mysqli_stmt_bind_param($stmt, 'ssssss', $user_id, $tanggal, $waktu, $deskripsi, $lokasi, $foto);

// Eksekusi statement
$query = mysqli_stmt_execute($stmt);

if ($query) {
    // Pindahkan file ke direktori tujuan
    move_uploaded_file($tmp_name, $upload_dir . $foto);

    // Tampilkan SweetAlert jika berhasil disimpan
    echo "<script src='dist/sweetalert2.all.min.js'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Catatan Berhasil Disimpan',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0275d8'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'user.php?url=catatan_perjalanan';
                    }
                });
            });
            </script>";
} else {
    // Tampilkan SweetAlert jika terjadi kesalahan
    echo "<script src='dist/sweetalert2.all.min.js'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan Catatan. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'user.php?url=catatan_perjalanan';
                    }
                });
            });
            </script>";
}

// Tutup statement
mysqli_stmt_close($stmt);

// Tutup koneksi
mysqli_close($conn);
