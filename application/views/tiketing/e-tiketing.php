<?php
if (!$this->session->userdata('role') || !in_array($this->session->userdata('role'), ['User'])) {
    redirect('auth');
    exit;
}
?>

<?php $this->load->view('layout/header'); ?>

<style>
    .form-group>label {
        display: block;
        margin-bottom: 0.5rem;
    }

    .remove-image-btn {
        position: absolute;
        top: -0.5rem;
        right: -0.5rem;
        background-color: rgba(255, 255, 255, 0);
        color: white;
        border-radius: 9999px;
        width: 1.75rem;
        height: 1.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        line-height: 1;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    input[type="file"] {
        max-width: 100%;
    }

    .validation-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: none;
    }
</style>

<div class="container mx-auto px-4 py-16 sm:px-6 lg:py-10 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">

        <div class="p-4 md:p-6 lg:p-8 border-b bg-gray-50">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center">
                <i class="bi bi-ticket-perforated mr-3 text-blue-600"></i> Form Pengaduan e-Tiketing
            </h2>
        </div>

        <div class="p-4 md:p-6 lg:p-8 space-y-4">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="flex items-center p-4 text-sm text-green-800 rounded-lg bg-green-100 border border-green-200" role="alert">
                    <i class="bi bi-check-circle-fill mr-2 flex-shrink-0"></i>
                    <div><span class="font-medium">Sukses!</span> <?= $this->session->flashdata('success'); ?></div>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="flex items-center p-4 text-sm text-red-800 rounded-lg bg-red-100 border border-red-200" role="alert">
                    <i class="bi bi-exclamation-triangle-fill mr-2 flex-shrink-0"></i>
                    <div><span class="font-medium">Error!</span> <?= $this->session->flashdata('error'); ?></div>
                </div>
            <?php endif; ?>
        </div>

        <?= form_open_multipart('tiketing/submit', ['class' => 'needs-validation', 'novalidate' => '', 'id' => 'pengaduan-form']); ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">

            <div class="lg:col-span-2 p-4 md:p-6 lg:p-8 border-r-0 lg:border-r border-gray-200">
                <div class="space-y-6">

                    <div class="form-group">
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-tag mr-2 text-gray-500"></i> Kategori Layanan <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select name="kategori" id="kategori" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white" required>
                            <option value="" disabled selected>Pilih Layanan</option>
                            <option value="peminjaman_ruangan">Peminjaman Ruangan</option>
                            <option value="peminjaman_peralatan">Peminjaman Peralatan</option>
                            <option value="permintaan_meja_kursi">Permintaan Kursi/Meja</option>
                            <option value="penggunaan_kendaraan">Penggunaan Kendaraan</option>
                            <option value="perbaikan_ac">Perbaikan AC/Kipas</option>
                            <option value="perbaikan_meja_kursi">Perbaikan Meja/Kursi/Papan</option>
                            <option value="perbaikan_listrik">Perbaikan Listrik/Lampu</option>
                            <option value="perbaikan_internet">Perbaikan Internet</option>
                            <option value="perbaikan_toilet">Perbaikan Toilet</option>
                            <option value="perbaikan_pintu">Perbaikan Pintu/Jendela</option>
                            <option value="pembersihan_ruangan">Pembersihan Ruangan</option>
                            <option value="laporan_kerusakan">Laporan Kerusakan Lain</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <div class="validation-message" id="kategori-error">Silakan pilih kategori.</div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-pencil-square mr-2 text-gray-500"></i> Deskripsi <span class="text-red-500 ml-1">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" rows="4" required placeholder="Jelaskan detail permintaan atau masalah Anda di sini..."></textarea>
                        <div class="validation-message" id="deskripsi-error">Silakan isi deskripsi (minimal 10 karakter).</div>
                    </div>

                    <div class="form-group">
                        <label for="lokasi" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-geo-alt mr-2 text-gray-500"></i> Lokasi Terkait <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select name="lokasi" id="lokasi" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white" required>
                            <option value="" disabled selected>Pilih Lokasi</option>
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
                        <div class="validation-message" id="lokasi-error">Silakan pilih lokasi.</div>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center mb-2">
                            <i class="bi bi-camera mr-2 text-gray-500"></i> Foto Pendukung (Opsional)
                        </label>
                        <p class="text-gray-600 text-xs italic mb-3">Maks 3 foto (JPG/JPEG, maks 2MB/foto).</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border border-gray-200 p-4 rounded-md bg-gray-50">
                            <div>
                                <label for="upload-foto" class="block text-sm font-medium text-gray-600 mb-1">1. Unggah File</label>
                                <input type="file" name="upload_foto[]" id="upload-foto" accept="image/jpeg, image/jpg" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" aria-label="Unggah Foto" multiple>
                                <p class="text-gray-500 text-xs italic mt-1">Pilih file dari perangkat.</p>
                                <div class="validation-message" id="upload-foto-error"></div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">2. Ambil Foto</label>
                                <div id="camera-container" class="w-full p-3 border border-gray-300 rounded-md bg-white mt-1 hidden">
                                    <div id="camera" class="mb-3 mx-auto w-full max-w-[320px] h-[240px] border border-gray-200 rounded overflow-hidden bg-gray-100 flex items-center justify-center text-gray-400">
                                        <i class="bi bi-camera-video text-3xl"></i>
                                    </div>
                                    <div class="flex justify-center space-x-3">
                                        <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition" onclick="takeSnapshot()">
                                            <i class="bi bi-camera-fill mr-1"></i> Ambil
                                        </button>
                                        <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition" onclick="cancelCamera()">
                                            <i class="bi bi-x-lg mr-1"></i> Batal
                                        </button>
                                    </div>
                                </div>
                                <button type="button" id="open-camera-btn" class="inline-flex items-center w-full justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition mt-1">
                                    <i class="bi bi-camera-video-fill mr-2"></i> Buka Kamera
                                </button>
                            </div>
                        </div>
                        <div id="file-names-info" class="mt-2 text-sm text-gray-600"></div>
                    </div>

                </div>
            </div>
            <div class="lg:col-span-1 p-4 md:p-6 lg:p-8 bg-gray-50 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto">
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 flex items-center">
                        <i class="bi bi-receipt mr-2 text-gray-500"></i> Ringkasan Pengaduan
                    </h3>

                    <div id="preview-container" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Terlampir (Maks 3):</label>
                        <div id="preview-images" class="flex flex-wrap gap-3 bg-white p-3 rounded border border-gray-200 min-h-[80px] items-center">
                            <p id="no-preview-text" class="text-xs text-gray-400 italic">Belum ada foto terlampir.</p>
                        </div>
                        <div id="preview-file-names" class="mt-2 text-xs text-gray-500">
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-300">
                        <button type="submit" id="submit-button" class="inline-flex items-center justify-center w-full px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            <i class="bi bi-send mr-2"></i> Kirim Pengaduan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close(); ?>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const pengaduanForm = document.getElementById('pengaduan-form');
        const uploadFotoInput = document.getElementById('upload-foto');
        const previewContainer = document.getElementById('preview-container');
        const previewImages = document.getElementById('preview-images');
        const previewFileNames = document.getElementById('preview-file-names');
        const noPreviewText = document.getElementById('no-preview-text');
        const cameraContainer = document.getElementById('camera-container');
        const openCameraBtn = document.getElementById('open-camera-btn');
        const cameraElement = document.getElementById('camera');

        let uploadedFilesData = new DataTransfer();
        const MAX_FILES = 3;
        const MAX_FILE_SIZE_MB = 2;
        const MAX_FILE_SIZE_BYTES = MAX_FILE_SIZE_MB * 1024 * 1024;
        const ALLOWED_TYPES = ['image/jpeg', 'image/jpg'];

        uploadFotoInput.addEventListener('change', handleFileInputChange);
        openCameraBtn.addEventListener('click', openCamera);
        pengaduanForm.addEventListener('submit', handleFormSubmit);

        function handleFileInputChange(event) {
            handleFiles(event.target.files);
            uploadFotoInput.files = uploadedFilesData.files;
        }

        function openCamera() {
            if (getTotalFilesCount() >= MAX_FILES) {
                showValidationError('upload-foto-error', `Batas maksimal ${MAX_FILES} foto tercapai.`);
                return;
            }
            clearValidationError('upload-foto-error');
            cameraContainer.classList.remove('hidden');
            openCameraBtn.classList.add('hidden');
            Webcam.reset();
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90,
                flip_horiz: true
            });
            Webcam.attach(cameraElement);
            Webcam.on('live', function() {
                cameraElement.innerHTML = '';
            });
            Webcam.on('error', function(err) {
                console.error("Webcam Error:", err);
                showValidationError('upload-foto-error', `Tidak dapat mengakses kamera: ${err.name}. Pastikan Anda memberikan izin.`);
                cancelCamera();
            });
        }

        window.takeSnapshot = function() {
            if (getTotalFilesCount() >= MAX_FILES) {
                showValidationError('upload-foto-error', `Batas maksimal ${MAX_FILES} foto tercapai.`);
                cancelCamera();
                return;
            }
            clearValidationError('upload-foto-error');
            Webcam.snap(function(data_uri) {
                const imageName = `capture_${Date.now()}.jpg`;
                const blob = dataURItoBlob(data_uri);
                if (blob.size > MAX_FILE_SIZE_BYTES) {
                    showValidationError('upload-foto-error', `Foto dari kamera (${(blob.size / 1024 / 1024).toFixed(1)} MB) melebihi batas ${MAX_FILE_SIZE_MB}MB.`);
                    cancelCamera();
                    return;
                }
                const file = new File([blob], imageName, {
                    type: 'image/jpeg'
                });

                uploadedFilesData.items.add(file);
                uploadFotoInput.files = uploadedFilesData.files;
                addImageToPreview(data_uri, imageName, file);
                cancelCamera();
            });
        }

        window.cancelCamera = function() {
            if (Webcam.live) {
                Webcam.reset();
            }
            cameraElement.innerHTML = '<i class="bi bi-camera-video text-3xl"></i>';
            cameraContainer.classList.add('hidden');
            openCameraBtn.classList.remove('hidden');
        }

        function handleFiles(files) {
            const currentFileCount = getTotalFilesCount();
            let addedCount = 0;
            let canAddCount = MAX_FILES - currentFileCount;

            if (files.length > canAddCount && canAddCount > 0) {
                showValidationError('upload-foto-error', `Anda memilih ${files.length} foto, tetapi hanya ${canAddCount} yang bisa ditambahkan (batas ${MAX_FILES}).`);
            } else if (files.length > 0 && canAddCount <= 0) {
                showValidationError('upload-foto-error', `Tidak bisa menambah foto lagi, batas maksimal ${MAX_FILES} sudah tercapai.`);
                return;
            } else {
                clearValidationError('upload-foto-error');
            }

            Array.from(files).every(file => {
                if (getTotalFilesCount() >= MAX_FILES) {
                    return false;
                }

                if (!ALLOWED_TYPES.includes(file.type)) {
                    showValidationError('upload-foto-error', `File "${file.name}" (${file.type}) bukan format ${ALLOWED_TYPES.join('/')}.`);
                    return true;
                }
                if (file.size > MAX_FILE_SIZE_BYTES) {
                    showValidationError('upload-foto-error', `File "${file.name}" (${(file.size / 1024 / 1024).toFixed(1)} MB) melebihi batas ${MAX_FILE_SIZE_MB}MB.`);
                    return true;
                }
                if (isFileAlreadyAdded(file.name)) {
                    return true;
                }
                clearValidationError('upload-foto-error');

                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadedFilesData.items.add(file);
                    uploadFotoInput.files = uploadedFilesData.files;
                    addImageToPreview(e.target.result, file.name, file);
                    addedCount++;
                };
                reader.onerror = function() {
                    console.error("FileReader error for file:", file.name);
                    showValidationError('upload-foto-error', `Gagal membaca file "${file.name}".`);
                };
                reader.readAsDataURL(file);

                return true;
            });
        }

        function addImageToPreview(src, name, fileObject) {
            const imgContainer = document.createElement('div');
            imgContainer.classList.add('relative', 'w-20', 'h-20', 'sm:w-24', 'sm:h-24', 'border', 'border-gray-300', 'rounded-md', 'overflow-hidden', 'shadow-sm', 'bg-white');
            imgContainer.dataset.fileName = name;

            const img = document.createElement('img');
            img.src = src;
            img.alt = name;
            img.classList.add('w-full', 'h-full', 'object-cover');
            imgContainer.appendChild(img);

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.innerHTML = '<i class="bi bi-x"></i>';
            removeButton.classList.add('remove-image-btn');
            removeButton.title = `Hapus ${name}`;
            removeButton.setAttribute('aria-label', `Hapus ${name}`);

            removeButton.addEventListener('click', function() {
                const parent = this.parentElement;
                const fileNameToRemove = parent.dataset.fileName;

                previewImages.removeChild(parent);

                const dt = new DataTransfer();
                const currentFiles = Array.from(uploadedFilesData.files);
                currentFiles.forEach(file => {
                    if (file.name !== fileNameToRemove) {
                        dt.items.add(file);
                    }
                });
                uploadedFilesData = dt;
                uploadFotoInput.files = uploadedFilesData.files;

                updateFileNamesDisplay();
                checkPreviewContainerVisibility();
                clearValidationError('upload-foto-error');
            });

            imgContainer.appendChild(removeButton);
            previewImages.appendChild(imgContainer);

            updateFileNamesDisplay();
            checkPreviewContainerVisibility();
        }

        function updateFileNamesDisplay() {
            previewFileNames.innerHTML = '';
            const currentFiles = Array.from(uploadedFilesData.files);
            if (currentFiles.length > 0) {
                let fileListHTML = `<strong>${currentFiles.length} dari ${MAX_FILES} foto terlampir:</strong><ul class="list-disc list-inside mt-1">`;
                currentFiles.forEach(file => {
                    fileListHTML += `<li class="truncate" title="${file.name} (${(file.size / 1024).toFixed(1)} KB)">${file.name} (${(file.size / 1024).toFixed(1)} KB)</li>`;
                });
                fileListHTML += `</ul>`;
                previewFileNames.innerHTML = fileListHTML;
            }
        }

        function checkPreviewContainerVisibility() {
            const fileCount = getTotalFilesCount();
            if (fileCount > 0) {
                noPreviewText.classList.add('hidden');
            } else {
                noPreviewText.classList.remove('hidden');
                previewFileNames.innerHTML = '';
            }
        }

        function getTotalFilesCount() {
            return uploadedFilesData.files.length;
        }

        function isFileAlreadyAdded(fileName) {
            const currentFiles = Array.from(uploadedFilesData.files);
            return currentFiles.some(file => file.name === fileName);
        }

        function dataURItoBlob(dataURI) {
            try {
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
            } catch (e) {
                console.error("Error converting data URI to Blob:", e);
                return null;
            }
        }

        function showValidationError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        function clearValidationError(elementId) {
            const errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }

        function validateForm() {
            let isValid = true;
            document.querySelectorAll('.validation-message').forEach(el => el.style.display = 'none');

            const kategori = document.getElementById('kategori').value;
            const deskripsi = document.getElementById('deskripsi').value;
            const lokasi = document.getElementById('lokasi').value;

            if (!kategori) {
                showValidationError('kategori-error', 'Silakan pilih kategori.');
                isValid = false;
            }
            if (!deskripsi || deskripsi.length < 10) {
                showValidationError('deskripsi-error', 'Silakan isi deskripsi (minimal 10 karakter).');
                isValid = false;
            }
            if (!lokasi) {
                showValidationError('lokasi-error', 'Silakan pilih lokasi.');
                isValid = false;
            }

            if (!isValid) {
                const firstError = document.querySelector('.validation-message[style*="display: block"]');
                firstError?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            return isValid;
        }


        function handleFormSubmit(event) {
            if (!validateForm()) {
                event.preventDefault();
                const submitButton = document.getElementById('submit-button');
                if (submitButton) {
                    submitButton.classList.add('bg-red-500', 'hover:bg-red-600');
                    setTimeout(() => {
                        submitButton.classList.remove('bg-red-500', 'hover:bg-red-600');
                    }, 1500);
                }
            } else {
                const submitButton = document.getElementById('submit-button');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<i class="bi bi-arrow-repeat animate-spin mr-2"></i> Mengirim...';
                }
            }
        }

        checkPreviewContainerVisibility();

    });
</script>

<?php $this->load->view('layout/footer'); ?>