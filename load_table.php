<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$start = ($page - 1) * $limit;

$user_id = $_SESSION['user_id'];
$searchQuery = $search ? "AND (lokasi LIKE '%$search%' OR deskripsi LIKE '%$search%')" : "";
$filterQuery = '';

if ($filter === 'newest') {
    $filterQuery = "ORDER BY tanggal DESC";
} elseif ($filter === 'oldest') {
    $filterQuery = "ORDER BY tanggal ASC";
}

$sql = "SELECT id_table, lokasi, tanggal, waktu, foto, deskripsi FROM catatan WHERE user_id = $user_id $searchQuery $filterQuery LIMIT $start, $limit";
$result = $conn->query($sql);

$totalResults = $conn->query("SELECT COUNT(*) FROM catatan WHERE user_id = $user_id $searchQuery")->fetch_row()[0];
$totalPages = ceil($totalResults / $limit);
$prevPage = ($page > 1) ? $page - 1 : 1;
$nextPage = ($page < $totalPages) ? $page + 1 : $totalPages;

if ($result->num_rows > 0) {
    echo "<div class='table-responsive'>";
    echo "<table class='table mx-auto'><thead><tr><th>Lokasi</th><th>Tanggal</th><th>Waktu</th><th>Foto</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        $imagePath = $row["foto"];
        echo "<tr onclick=\"showModal('" . $row["id_table"] . "', '" . $row["lokasi"] . "', '" . $row["tanggal"] . "', '" . $row["waktu"] . "', '" . $row["deskripsi"] . "', '" . $imagePath . "')\">";
        echo "<td>" . $row["lokasi"] . "</td>";
        echo "<td>" . $row["tanggal"] . "</td>";
        echo "<td>" . $row["waktu"] . "</td>";
        echo "<td><div class='photo-description-container'><img src='path/to/upload/directory/" . $imagePath . "' alt='Foto Perjalanan'></div></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    echo "</div>";

    echo "<ul class='pagination justify-content-center'>";
    echo "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='loadTableData($prevPage)'>Previous</a></li>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<li class='page-item" . ($page == $i ? " active" : "") . "'><a class='page-link' href='javascript:void(0)' onclick='loadTableData($i)'>$i</a></li>";
    }
    echo "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='loadTableData($nextPage)'>Next</a></li>";
    echo "</ul>";
} else {
    echo "<p class='text-center'>0 results</p>";
}
$conn->close();
?>
