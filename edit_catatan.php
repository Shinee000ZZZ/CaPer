<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

$id_table = $_POST['id_table'];

$sql = "SELECT lokasi, tanggal, waktu, foto, deskripsi FROM catatan WHERE id_table = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_table);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        body h4 {
            margin-left: 20px;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
        }

        .frame {
            width: 100%;
            max-width: 400px;
            height: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            overflow: hidden;
        }

        .placeholder {
            color: #666;
            font-size: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .placeholder i {
            font-size: 48px;
            margin-top: 10px;
        }

        #video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Agar video menyesuaikan ukuran frame */
        }

        #canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 1;
            /* Pastikan canvas berada di atas video */
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 20px;
            margin-top: 10px;
        }

        .button-group {
            display: flex;
            gap: 20px;
        }

        .camera-button,
        .choose-file-button,
        .take-picture-button {
            margin-top: 0px;
        }

        .preview-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            /* Sesuaikan dengan kebutuhan */
            height: 400px;
            /* Sesuaikan dengan kebutuhan */
        }

        .preview-container img {
            max-width: 100%;
            max-height: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h4>Edit Catatan Perjalanan Anda</h4>
    <div class="card-body">
        <form id="editForm" action="update_catatan.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_table" value="<?php echo $id_table; ?>">
            <div class="form-group">
                <label for="tanggal">Tanggal Perjalanan</label>
                <input id="tanggal" name="tanggal" class="form-control" type="date" value="<?php echo $row['tanggal']; ?>" required>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu Perjalanan</label>
                <input id="waktu" name="waktu" class="form-control" type="time" value="<?php echo $row['waktu']; ?>" step="1" required>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi Perjalanan</label>
                <input id="locationInput" name="lokasi" class="form-control" type="text" value="<?php echo $row['lokasi']; ?>" required>
                <button type="button" id="getLocationBtn" class="btn btn-primary mt-3">Dapatkan lokasi saat ini <i class="fas fa-map-marker-alt ml-1"></i></button>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Perjalanan</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Gambar Perjalanan</label>
                <div class="frame">
                    <img src="path/to/upload/directory/<?php echo $row['foto']; ?>" alt="Foto Perjalanan" id="existingImage">
                    <video id="video" autoplay></video>
                    <canvas id="canvas"></canvas>
                    <div class="placeholder" id="filePlaceholder">Pilih foto Anda</i></div>
                </div>
                <button type="button" id="cameraButton" class="btn btn-primary camera-button mr-3">Buka Kamera</i></button>
                <button type="button" id="takePictureButton" class="btn btn-primary take-picture-button mr-3">Ambil Gambar</i></button>
                <button type="button" id="chooseFileButton" class="btn btn-primary mr-3">Pilih File</button>
                <input id="fileInput" name="foto" class="form-control" type="file" accept="image/*" style="display: none;">
            </div>
            <div class="form-group button-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='user.php?url=catatan_perjalanan'">Kembali</i> </button>
            </div>
        </form>
    </div>

    <script src="dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form default submit

            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: response.message,
                            confirmButtonColor: '#0275d8',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'user.php?url=catatan_perjalanan';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Gagal mengupdate data. Coba lagi nanti.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            };

            xhr.onerror = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            };

            xhr.send(formData);
        });

        document.getElementById('fileInput').addEventListener('change', function() {
            const fileInput = document.getElementById('fileInput');
            const filePlaceholder = document.getElementById('filePlaceholder');
            const existingImage = document.getElementById('existingImage');

            // Hapus gambar yang ada saat ini
            existingImage.style.display = 'none';

            // Periksa apakah pengguna memilih file baru
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const reader = new FileReader();

                // Mengatur fungsi onload untuk membaca dan menampilkan gambar yang dipilih
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Foto Perjalanan';
                    img.className = 'preview-image'; // Ganti sesuai kebutuhan
                    img.onload = function() {
                        URL.revokeObjectURL(img.src); // Bebaskan objek URL setelah memuat gambar
                    };

                    // Menambahkan gambar baru ke dalam frame
                    const frame = document.querySelector('.frame');
                    frame.appendChild(img);

                    // Menampilkan nama file yang dipilih sebagai placeholder
                    filePlaceholder.innerHTML = `${file.name}`;
                    filePlaceholder.style.color = 'black';
                    filePlaceholder.style.fontWeight = 'bold';
                };

                // Baca file sebagai URL data
                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file yang dipilih, kembalikan placeholder
                filePlaceholder.innerHTML = 'Pilih foto Anda <i class="fa-regular fa-image style=" display:block;"></i>';
                filePlaceholder.style.color = '#666';
                filePlaceholder.style.fontWeight = 'normal';
            }
        });

        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('waktu').value = timeString;
        }

        setInterval(updateTime, 1000);
        updateTime();

        document.getElementById('getLocationBtn').addEventListener('click', function() {
            const locationInput = document.getElementById('locationInput');
            locationInput.placeholder = 'Melacak lokasi...';
            locationInput.value = '';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true
                });
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
                locationInput.placeholder = 'Masukkan Lokasi';
            }
        });

        function showPosition(position) {
            const locationInput = document.getElementById('locationInput');
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const nominatimUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`;

            fetch(nominatimUrl)
                .then(response => response.json())
                .then(data => {
                    locationInput.value = data.display_name;
                    locationInput.placeholder = 'Masukkan Lokasi';
                })
                .catch(error => {
                    console.error('Error fetching address from Nominatim:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops..',
                        text: 'Gagal mendapatkan alamat dari koordinat GPS.',
                    });
                    locationInput.placeholder = 'Masukkan Lokasi';
                });
        }

        function showError(error) {
            const locationInput = document.getElementById('locationInput');
            let errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = "Pengguna menolak permintaan Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    errorMessage = "Permintaan Geolocation habis waktu.";
                    break;
                case error.UNKNOWN_ERROR:
                    errorMessage = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: errorMessage
            });
            locationInput.placeholder = 'Masukkan Lokasi';
        }

        // Ambil gambar dari kamera
        const cameraButton = document.getElementById('cameraButton');
        const video = document.getElementById('video');
        const takePictureButton = document.getElementById('takePictureButton');
        const canvas = document.getElementById('canvas');
        const fileInput = document.getElementById('fileInput');
        const resetButton = document.getElementById('resetButton');
        const filePlaceholder = document.getElementById('filePlaceholder');

        function captureImage() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/jpeg');
            const blob = dataURItoBlob(dataUrl);
            const randomFileName = generateRandomString() + '.jpg';
            const file = new File([blob], randomFileName, {
                type: 'image/jpeg'
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            filePlaceholder.innerHTML = `${randomFileName}`;
            filePlaceholder.style.color = 'black';
            filePlaceholder.style.fontWeight = 'bold';
        }

        function resetForm() {
            // Reset nilai-nilai input pada formulir
            document.getElementById('editForm').reset();

            // Reset tampilan video dan canvas
            video.style.display = 'none';
            canvas.style.display = 'none';

            // Hapus gambar yang diambil sebelumnya dari canvas
            const context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);

            // Matikan kamera jika sedang menyala
            if (video.srcObject) {
                const stream = video.srcObject;
                const tracks = stream.getTracks();
                tracks.forEach(track => {
                    track.stop();
                });
            }

            // Tampilkan kembali placeholder untuk gambar
            filePlaceholder.style.display = 'block';
            filePlaceholder.innerHTML = 'Pilih foto Anda <i class="fa-regular fa-image" style="display:block;"></i>';
            filePlaceholder.style.color = '#666';
            filePlaceholder.style.fontWeight = 'normal';
        }

        function generateRandomString() {
            return Math.random().toString(36).substring(7);
        }

        function dataURItoBlob(dataURI) {
            const byteString = atob(dataURI.split(',')[1]);
            const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {
                type: mimeString
            });
        }

        function setupCamera() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(stream => {
                    video.srcObject = stream;
                    video.style.display = 'block';
                    canvas.style.display = 'none';
                    takePictureButton.style.display = 'inline-block';
                    filePlaceholder.style.display = 'none';
                    video.onloadedmetadata = function(e) {
                        video.play();
                    };
                })
                .catch(error => {
                    alert('Tidak dapat mengakses kamera: ' + error.message);
                });
        }

        cameraButton.addEventListener('click', function() {
            setupCamera();
        });

        takePictureButton.addEventListener('click', function() {
            captureImage();
            video.style.display = 'none';
            canvas.style.display = 'block';
        });

        const chooseFileButton = document.getElementById('chooseFileButton');
        chooseFileButton.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                filePlaceholder.innerHTML = `${file.name}`;
                filePlaceholder.style.color = 'black';
                filePlaceholder.style.fontWeight = 'bold';
            } else {
                filePlaceholder.innerHTML = 'Pilih foto Anda <i class="fa-regular fa-image style=" display:block;"></i>';
                filePlaceholder.style.color = '#666';
                filePlaceholder.style.fontWeight = 'normal';
            }
        });

        resetButton.addEventListener('click', function() {
            fileInput.value = ''; // reset input file
            filePlaceholder.innerHTML = 'Pilih foto Anda <i class="fa-regular fa-image" style="display:block;"></i>';
            filePlaceholder.style.color = '#666';
            filePlaceholder.style.fontWeight = 'normal';
        });
    </script>

</body>

</html>
<?php
$conn->close();
?>