<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

$id_table = $_POST['id_table'];
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$lokasi = $_POST['lokasi'];
$deskripsi = $_POST['deskripsi'];
$foto = $_FILES['foto']['name'];

if ($foto) {
    $target_dir = "path/to/upload/directory/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    $sql = "UPDATE catatan SET tanggal = ?, waktu = ?, lokasi = ?, deskripsi = ?, foto = ? WHERE id_table = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $tanggal, $waktu, $lokasi, $deskripsi, $foto, $id_table);
} else {
    $sql = "UPDATE catatan SET tanggal = ?, waktu = ?, lokasi = ?, deskripsi = ? WHERE id_table = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $tanggal, $waktu, $lokasi, $deskripsi, $id_table);
}

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Data berhasil diupdate.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Gagal mengupdate data: ' . $stmt->error;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
