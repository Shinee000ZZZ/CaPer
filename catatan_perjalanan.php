<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perjalanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 100%;
            top: -30px;
        }

        body h4 {
            margin-bottom: 20px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: justify;
        }

        th:first-child,
        td:first-child {
            width: 65%;
        }

        th {
            background-color: #f2f2f2;
        }

        .photo-description-container {
            display: flex;
            align-items: center;
        }

        .photo-description-container img {
            max-width: 150px;
            max-height: 150px;
            margin-right: 20px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 9909;
            left: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-image {
            max-width: 700px;
            max-height: 700px;
            object-fit: cover;
            border-radius: 10px;
            margin: 10px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            bottom: 30px;
            display: flex;
            justify-content: space-between;
            position: relative;
            flex-direction: column;
        }

        .close {
            color: #aaa;
            font-size: 50px;
            position: absolute;
            top: 20px;
            right: 30px;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-table {
            width: 100%;
        }

        .modal-table th {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: left;
        }

        .modal-table td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .modal-table td:first-child {
            width: 10%;
        }

        /* Hover effect for table rows */
        tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .modal-buttons button {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background-image: linear-gradient(to right, transparent 50%, #0d6efd 50%);
            background-size: 200% 100%;
            background-color: transparent;
            transition: background-position 0.3s ease;
            color: #0d6efd;
            border: 1px solid #0d6efd;
        }

        .modal-buttons .edit-btn:hover,
        .modal-buttons .delete-btn:hover {
            background-position: -99.9% 0;
            color: white;
        }

        .swal2-container {
            z-index: 9999;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            color: #0275d8;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .pagination li a:hover {
            background-color: #ddd;
        }

        .pagination .active a {
            background-color: #0275d8;
            color: white;
            border: 1px solid #0275d8;
        }

        #search {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #filter {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <h4>Tabel Data Perjalanan</h4>
    <div class="row">
        <div class="col-md-6">
            <input type="text" id="search" placeholder="Cari ..." class="form-control">
        </div>
        <div class="col-md-3">
            <select id="filter" class="form-control">
                <option value="">FILTER</option>
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
            </select>
        </div>
    </div>
    <div id="table-container">
        <!-- Tabel akan dimuat di sini -->
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
            <div class="modal-buttons">
                <form action="user.php?url=edit_catatan" method="post" id="editForm">
                    <input type="hidden" name="id_table" value="">
                    <input type="hidden" name="lokasi" value="">
                    <input type="hidden" name="tanggal" value="">
                    <input type="hidden" name="waktu" value="">
                    <input type="hidden" name="deskripsi" value="">
                    <input type="hidden" name="foto" value="">
                    <button class="edit-btn" type="submit">Edit</button>
                </form>
                <form action="hapus_catatan.php" method="post" id="deleteForm">
                    <input type="hidden" name="id_table" value="">
                    <button class="delete-btn" type="button" onclick="confirmDelete()">Hapus</button>
                </form>

            </div>
        </div>
    </div>

    <script src="dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadTableData();

            document.getElementById("search").addEventListener("input", function() {
                loadTableData();
            });

            document.getElementById("filter").addEventListener("change", function() {
                loadTableData();
            });
        });

        function confirmDelete() {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm").submit();
                }
            });
        }

        function loadTableData(page = 1) {
            const search = document.getElementById("search").value;
            const filter = document.getElementById("filter").value;

            const xhr = new XMLHttpRequest();
            xhr.open("GET", `load_table.php?search=${search}&filter=${filter}&page=${page}`, true);
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("table-container").innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        function showModal(id_table, lokasi, tanggal, waktu, deskripsi, foto) {
            document.getElementById("modalContent").innerHTML = "<table class='modal-table'><tr><td><img src='path/to/upload/directory/" + foto + "' alt='Foto Perjalanan' class='modal-image'></td><td><table><tr><th>Lokasi:</th><td>" + lokasi + "</td></tr><tr><th>Tanggal:</th><td>" + tanggal + "</td></tr><tr><th>Waktu:</th><td>" + waktu + "</td></tr><tr><th>Deskripsi:</th><td>" + deskripsi + "</td></tr></table></td></tr></table>";

            document.getElementById("editForm").elements["id_table"].value = id_table;
            document.getElementById("editForm").elements["lokasi"].value = lokasi;
            document.getElementById("editForm").elements["tanggal"].value = tanggal;
            document.getElementById("editForm").elements["waktu"].value = waktu;
            document.getElementById("editForm").elements["deskripsi"].value = deskripsi;
            document.getElementById("editForm").elements["foto"].value = foto;

            document.getElementById("deleteForm").elements["id_table"].value = id_table;

            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        }
    </script>
</body>

</html>