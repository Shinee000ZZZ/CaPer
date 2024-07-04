<?php
$servername = "localhost";  // biasanya "localhost"
$username = "root";         // username database
$password = "";             // password database
$dbname = "caper";          // nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
