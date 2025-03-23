<?php $this->load->view('layout/header'); ?> <br>

<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
            display: flexbox;
            justify-content: center;
        }
    }

    .grid.grid-cols-2.gap-4 > div {
        display: flex;
        flex-direction: column; 
        align-items: flex-start;
        justify-content: flex-start;
    }
</style>

<div class="form-container mt-20 px-40">
    <h2 class="mb-4 text-2xl font-bold">Form e-Tiketing</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="p-4 mb-4 text-green-800 bg-green-200 rounded">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="p-4 mb-4 text-red-800 bg-red-200 rounded">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?= form_open_multipart('tiketing/e-tiketing', ['class' => 'needs-validation', 'novalidate' => '', 'id' => 'pengaduan-form']); ?>

    <div class="my-4">
        <label for="kategori" class="block font-medium">Kategori Layanan</label>
        <select name="kategori" class="w-full p-2 mt-2 border rounded" required>
            <option value="">Pilih Layanan</option>
            <option value="peminjaman_ruangan">Peminjaman Ruangan</option>
            <option value="peminjaman_peralatan">Peminjaman Peralatan (Proyektor, Speaker, Laptop, dll.)</option>
            <option value="permintaan_meja_kursi">Permintaan Kursi / Meja Tambahan di Ruangan</option>
            <option value="penggunaan_kendaraan">Permohonan Penggunaan Kendaraan Kampus</option>
            <option value="perbaikan_ac">Perbaikan AC / Kipas Angin</option>
            <option value="perbaikan_meja_kursi">Perbaikan Meja / Kursi / Papan Tulis</option>
            <option value="perbaikan_listrik">Perbaikan Listrik / Lampu / Stopkontak</option>
            <option value="perbaikan_internet">Perbaikan Jaringan Internet (WiFi / LAN)</option>
            <option value="perbaikan_toilet">Perbaikan Toilet / Kamar Mandi</option>
            <option value="perbaikan_pintu">Perbaikan Pintu / Jendela / Kunci</option>
            <option value="pembersihan_ruangan">Permintaan Pembersihan Ruangan / Area Kampus</option>
            <option value="laporan_kerusakan">Laporan Kerusakan di Area Kampus</option>
            <option value="lainnya">Lainnya</option>
        </select>
        <div class="text-red-500 text-sm hidden">Silakan pilih kategori pengaduan.</div>
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="block font-medium">Deskripsi</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded mt-2" rows="4" required></textarea>
        <div class="text-red-500 text-sm">Silakan isi deskripsi.</div>
    </div>

    <div class="mb-4">
        <label for="lokasi" class="block font-medium">Lokasi Terkait</label>
        <select name="lokasi" class="w-full p-2 border rounded mt-2" required>
            <option value="">Pilih Lokasi</option>
            <option value="gedung_a">Gedung A</option>
            <option value="gedung_b">Gedung B</option>
            <option value="gedung_c">Gedung C</option>
            <option value="perpustakaan">Perpustakaan</option>
            <option value="laboratorium">Laboratorium</option>
            <option value="aula">Aula</option>
            <option value="auditorium">Auditorium</option>
            <option value="kantin">Kantin</option>
            <option value="masjid">Masjid</option>
            <option value="parkiran">Area Parkir</option>
            <option value="toilet">Toilet Umum</option>
            <option value="lapangan">Lapangan</option>
            <option value="pos_satpam">Pos Satpam</option>
        </select>
        <div class="text-red-500 text-sm hidden">Silakan pilih lokasi kejadian.</div>
    </div>

    <div class="mb-4">
        <label for="foto" class="block font-medium">Unggah atau Ambil Foto (Maksimal 3 Foto)</label>
        <p class="text-gray-600 text-sm italic mb-2">Anda dapat mengunggah hingga 3 foto dari perangkat atau mengambil foto langsung menggunakan kamera.</p>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="upload-foto" class="block font-medium">Unggah Foto</label>
                <input type="file" name="upload_foto[]" id="upload-foto" accept="image/jpeg, image/jpg" class="w-full p-2 border rounded mt-2" aria-label="Unggah Foto" multiple>
                <p class="text-gray-600 text-sm italic mt-1">Format yang didukung: JPG, JPEG. Maksimal ukuran file: 2MB per foto.</p>
            </div>

            <div>
                <label for="ambil-foto" class="block font-medium">Ambil Foto</label>
                <div id="camera-container" class="w-full p-4 border border-gray-300 rounded mt-2 hidden">
                    <div id="camera" class="mb-2"></div>
                    <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="takeSnapshot()">Ambil Foto</button>
                    <button type="button" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 ml-2" onclick="cancelCamera()">Batal</button>
                </div>

                <button type="button" id="open-camera-btn" class="w-32 h-12 border rounded bg-blue-600 text-white hover:bg-blue-700 mt-2 flex items-center justify-center">
                    <i class="bi bi-camera-fill mr-2"></i> Buka Kamera
                </button>
                <input type="hidden" name="foto[]" id="foto">
            </div>
        </div>

        <div id="preview-container" class="mt-4 hidden">
            <div id="preview-images" class="flex gap-4"></div>
            <div id="preview-file-names" class="mt-2 text-sm text-gray-600"></div>
        </div>

        <div id="file-names" class="mt-2 text-sm text-gray-600"></div>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Kirim Pengaduan
        </button>
    </div>

    <script>
        const uploadFotoInput = document.getElementById('upload-foto');
        const previewContainer = document.getElementById('preview-container');
        const previewImages = document.getElementById('preview-images');
        const previewFileNames = document.getElementById('preview-file-names');
        const fileNamesContainer = document.getElementById('file-names');

        uploadFotoInput.addEventListener('change', function(event) {
            const files = event.target.files;
            updatePreviewAndFileNames(files);
        });

        document.getElementById('open-camera-btn').addEventListener('click', function() {
            document.getElementById('camera-container').classList.remove('hidden');
            this.classList.add('hidden');
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90,
                flip_horiz: true
            });
            Webcam.attach('#camera');
        });

        function takeSnapshot() {
            Webcam.snap(function(data_uri) {
                const imageName = `capture_image${previewImages.childElementCount + 1}.jpg`;
                addImageToPreview(data_uri, imageName);
                Webcam.reset();
                document.getElementById('camera-container').classList.add('hidden');
                document.getElementById('open-camera-btn').classList.remove('hidden');
            });
        }

        function cancelCamera() {
            Webcam.reset();
            document.getElementById('camera-container').classList.add('hidden');
            document.getElementById('open-camera-btn').classList.remove('hidden');
        }

        function updatePreviewAndFileNames(files) {
            if (files.length + previewImages.childElementCount > 3) {
                alert('Anda hanya dapat mengunggah maksimal 3 foto.');
                uploadFotoInput.value = '';
                return;
            }
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    addImageToPreview(e.target.result, file.name);
                };
                reader.readAsDataURL(file);
            });
        }

        function addImageToPreview(src, name) {
            const imgContainer = document.createElement('div');
            imgContainer.classList.add('relative', 'w-32', 'h-32', 'border', 'rounded', 'overflow-hidden');

            const img = document.createElement('img');
            img.src = src;
            img.alt = name;
            img.classList.add('w-full', 'h-full', 'object-cover');
            imgContainer.appendChild(img);

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '<i class="bi bi-x"></i>';
            removeButton.classList.add('absolute', '-top-1', '-right-1', 'text-red-500', 'rounded-full', 'text-xl', 'w-7', 'h-7', 'flex', 'items-center', 'justify-center');
            removeButton.addEventListener('click', function() {
                previewImages.removeChild(imgContainer);
                updateFileNames();
                if (previewImages.childElementCount === 0) {
                    previewContainer.classList.add('hidden');
                }
            });
            imgContainer.appendChild(removeButton);

            previewImages.appendChild(imgContainer);
            updateFileNames();
            previewContainer.classList.remove('hidden');
        }

        function updateFileNames() {
            previewFileNames.innerHTML = '';
            Array.from(previewImages.children).forEach((imgContainer, index) => {
                const img = imgContainer.querySelector('img');
                const fileName = document.createElement('p');
                fileName.textContent = img.alt;
                fileName.classList.add('text-gray-600', 'text-sm');
                previewFileNames.appendChild(fileName);
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = $this->input->post('kategori');
    $deskripsi = $this->input->post('deskripsi');
    $lokasi = $this->input->post('lokasi');
    $uploadedFiles = $_FILES['upload_foto'];

    $uploadPath = FCPATH . 'assets/uploads/' . date('Y/m/d/H');
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $uploadedFilePaths = [];
    if (!empty($uploadedFiles['name'][0])) {
        for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
            $fileName = time() . '_' . $uploadedFiles['name'][$i];
            $fileTmpName = $uploadedFiles['tmp_name'][$i];
            $fileDestination = $uploadPath . '/' . $fileName;

            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                $uploadedFilePaths[] = 'assets/uploads/' . date('Y/m/d/H') . '/' . $fileName;
            }
        }
    }

    // Simpan data ke database
    $data = [
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'lokasi' => $lokasi,
        'foto' => json_encode($uploadedFilePaths), // Simpan path foto dalam format JSON
        'created_at' => date('Y-m-d H:i:s'),
    ];

    if ($this->db->insert('pengaduan', $data)) {
        $this->session->set_flashdata('success', 'Pengaduan berhasil dikirim.');
    } else {
        $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengirim pengaduan.');
    }

    redirect('tiketing/e-tiketing');
}
?>
