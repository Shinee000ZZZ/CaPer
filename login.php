<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id']; // Menyimpan user_id dalam sesi
    header("Location: user.php");
    exit();
} else {
    echo "<script src='dist/sweetalert2.all.min.js'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Oops..',
                    text: 'Username atau Password Salah!',
                    icon: 'error',
                    confirmButtonColor: '#0275d8',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            });
            </script>";
    exit();
}
