<?php
include 'koneksi.php';

if (isset($_POST['id_table'])) {
    $id_table = $_POST['id_table'];
    $stmt = $conn->prepare("DELETE FROM catatan WHERE id_table = ?");
    $stmt->bind_param("i", $id_table);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script src='dist/sweetalert2.all.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Catatan Berhasil Dihapus',
                        icon: 'success',
                        confirmButtonColor: '#0275d8',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'user.php?url=catatan_perjalanan';
                        }
                    });
                });
                </script>";
    } else {
        echo "<script src='dist/sweetalert2.all.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal menghapus catatan',
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

    $stmt->close();
}

$conn->close();
