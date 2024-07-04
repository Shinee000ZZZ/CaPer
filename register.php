<?php
include 'koneksi.php';

$response = array('status' => '', 'message' => '', 'redirect' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi apakah username dan password kosong
    if (empty($username) || empty($password)) {
        $response['status'] = 'error';
        $response['message'] = 'Username dan password tidak boleh kosong';
        echo json_encode($response);
        exit();
    }

    // Menghindari SQL Injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Cek apakah username sudah digunakan
    $check_sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Username sudah digunakan, silakan pilih username lain';
    } else {
        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'success';
            $response['message'] = 'Pendaftaran berhasil';
            $response['redirect'] = 'index.php';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . mysqli_error($conn);
        }
    }
    echo json_encode($response);
}
?>
    