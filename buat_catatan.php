<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perjalanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .form-group {
            position: relative;
            top: -20px;
        }

        .form-group label {
            font-size: 25px;
            font-weight: bold;
        }

        .frame {
            width: 400px;
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

        #video,
        #canvas {
            width: 400px;
            height: 300px;
            display: none;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
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
    <div class="card-body">
        <form id="travelForm" action="simpan_catatan.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="form-group">
                <label class="mt-3">Tanggal Perjalanan</label>
                <input name="tanggal" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
                <label class="">Waktu Perjalanan</label>
                <input name="waktu" class="form-control" type="time" value="<?php echo date('H:i:s', time()); ?>" step="1" id="timeInput" readonly required>
            </div>
            <div class="form-group">
                <label class="display-6">Lokasi Perjalanan</label>
                <input name="lokasi" id="locationInput" class="form-control" type="text" placeholder="Masukkan Lokasi" required>
                <button id="getLocationBtn" type="button" class="btn btn-primary mt-2">Dapatkan Lokasi Saat Ini <i class="fas fa-map-marker-alt ml-1"></i></button>
            </div>
            <div class="form-group">
                <label class="display-6">Deskripsi Perjalanan</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan Deskripsi Perjalanan" required></textarea>
            </div>
            <div class="form-group">
                <label class="display-6">Ambil Gambar</label>
                <div class="frame">
                    <div class="placeholder" id="filePlaceholder">Pilih foto Anda <i class="fa-regular fa-image"></i></div>
                    <video id="video"></video>
                    <canvas id="canvas"></canvas>
                </div>
                <div class="button-container">
                    <div class="button-group">
                        <button id="cameraButton" type="button" class="btn btn-primary camera-button">Buka Kamera</button>
                        <button id="chooseFileButton" type="button" class="btn btn-primary choose-file-button">Pilih File</button>
                    </div>
                    <button id="takePictureButton" type="button" class="btn btn-primary take-picture-button">Ambil Gambar</button>
                </div>
                <input name="foto" class="form-control" type="file" accept="image/*" id="fileInput" style="display: none;">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" id="resetButton" class="btn btn-secondary">Reset</button>
        </form>
        <div class="preview-container">
            <img id="previewImage" src="#" alt="Preview Image" style="display: none;">
            <div id="fileName" class="text-center"></div>
        </div>
    </div>


    <script src="dist/sweetalert2.all.min.js"></script>
    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('timeInput').value = timeString;
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
    const frame = document.querySelector('.frame');
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
    document.getElementById('travelForm').reset();

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
    for (let i = 0; i < byteString.length; i++) { ia[i]=byteString.charCodeAt(i); } return new Blob([ab], { type: mimeString }); } function setupCamera() { navigator.mediaDevices.getUserMedia({ video: true }) .then(stream=> {
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
        resetForm();
        });
        </script>

</body>

</html>