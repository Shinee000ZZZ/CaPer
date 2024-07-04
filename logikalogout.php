<?php
// Mulai session
session_start();

// Hancurkan semua data sesi
session_destroy();

// Redirect ke halaman index.php setelah logout
header("Location: index.php");
exit;
