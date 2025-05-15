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
        background-color: #ef4444;
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

    .remove-image-btn:hover {
        background-color: #dc2626;
    }

    input[type="file"] {
        max-width: 100%;
    }

    .validation-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .is-invalid {
        border-color: #ef4444 !important;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
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

        <?php
        $form_data = $this->session->flashdata('form_data');
        $nama_pelapor_val = $this->session->userdata('name');
        $email_val = $this->session->userdata('email');
        $kategori_val = isset($form_data['kategori']) ? $form_data['kategori'] : '';
        $subjek_val = isset($form_data['subjek']) ? $form_data['subjek'] : '';
        $prioritas_val = isset($form_data['prioritas']) ? $form_data['prioritas'] : '';
        $deskripsi_val = isset($form_data['deskripsi']) ? $form_data['deskripsi'] : '';
        $lokasi_val = isset($form_data['lokasi']) ? $form_data['lokasi'] : '';
        $detail_lokasi_val = isset($form_data['detail_lokasi']) ? $form_data['detail_lokasi'] : '';
        $tanggal_kejadian_val = isset($form_data['tanggal_kejadian']) ? $form_data['tanggal_kejadian'] : '';
        $jadwal_kunjungan_val = isset($form_data['jadwal_kunjungan']) ? $form_data['jadwal_kunjungan'] : '';
        $catatan_tambahan_val = isset($form_data['catatan_tambahan']) ? $form_data['catatan_tambahan'] : '';
        ?>

        <?= form_open_multipart('tiketingcontroller/submit_tiketing', ['class' => 'needs-validation', 'novalidate' => '', 'id' => 'pengaduan-form']); ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">

            <div class="lg:col-span-2 p-4 md:p-6 lg:p-8 border-r-0 lg:border-r border-gray-200">
                <div class="space-y-6">
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-100 mb-6">
                        <h3 class="text-md font-semibold text-blue-800 mb-3 flex items-center">
                            <i class="bi bi-person-badge mr-2"></i> Informasi Pelapor
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="nama_pelapor" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="bi bi-person mr-2 text-gray-500"></i> Nama Lengkap <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" name="nama_pelapor" id="nama_pelapor"
                                    value="<?= html_escape($nama_pelapor_val); ?>"
                                    class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label for="email" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="bi bi-envelope mr-2 text-gray-500"></i> Email <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    value="<?= html_escape($email_val); ?>"
                                    class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-tag mr-2 text-gray-500"></i> Kategori Layanan <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select name="kategori" id="kategori" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white <?= form_error('kategori') ? 'is-invalid' : ''; ?>" required>
                            <option value="" disabled <?= empty($kategori_val) ? 'selected' : ''; ?>>Pilih Layanan</option>
                            <option value="Peminjaman Ruangan" <?= $kategori_val == 'peminjaman_ruangan' ? 'selected' : ''; ?>>Peminjaman Ruangan</option>
                            <option value="Peminjaman Peralatan" <?= $kategori_val == 'peminjaman_peralatan' ? 'selected' : ''; ?>>Peminjaman Peralatan</option>
                            <option value="Permintaan Kursi/Meja" <?= $kategori_val == 'permintaan_meja_kursi' ? 'selected' : ''; ?>>Permintaan Kursi/Meja</option>
                            <option value="Penggunaan Kendaraan" <?= $kategori_val == 'penggunaan_kendaraan' ? 'selected' : ''; ?>>Penggunaan Kendaraan</option>
                            <option value="Perbaikan AC/Kipas" <?= $kategori_val == 'perbaikan_ac' ? 'selected' : ''; ?>>Perbaikan AC/Kipas</option>
                            <option value="Perbaikan Meja/Kursi/Papan" <?= $kategori_val == 'perbaikan_meja_kursi' ? 'selected' : ''; ?>>Perbaikan Meja/Kursi/Papan</option>
                            <option value="Perbaikan Listrik/Lampu" <?= $kategori_val == 'perbaikan_listrik' ? 'selected' : ''; ?>>Perbaikan Listrik/Lampu</option>
                            <option value="Perbaikan Internet" <?= $kategori_val == 'perbaikan_internet' ? 'selected' : ''; ?>>Perbaikan Internet</option>
                            <option value="Perbaikan Toilet" <?= $kategori_val == 'perbaikan_toilet' ? 'selected' : ''; ?>>Perbaikan Toilet</option>
                            <option value="Perbaikan Pintu/Jendela" <?= $kategori_val == 'perbaikan_pintu' ? 'selected' : ''; ?>>Perbaikan Pintu/Jendela</option>
                            <option value="Pembersihan Ruangan" <?= $kategori_val == 'pembersihan_ruangan' ? 'selected' : ''; ?>>Pembersihan Ruangan</option>
                            <option value="Laporan Kerusakan Lain" <?= $kategori_val == 'laporan_kerusakan' ? 'selected' : ''; ?>>Laporan Kerusakan Lain</option>
                            <option value="Lainnya" <?= $kategori_val == 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                        </select>
                        <?= form_error('kategori'); ?>
                        <div class="validation-message" id="kategori-error" style="display:none;">Silakan pilih kategori.</div>
                    </div>

                    <div class="form-group">
                        <label for="subjek" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-chat-left-text mr-2 text-gray-500"></i> Subjek Tiket <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="subjek" id="subjek" value="<?= html_escape($subjek_val); ?>" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm <?= form_error('subjek') ? 'is-invalid' : ''; ?>" required placeholder="Contoh: Kerusakan AC Ruang 301">
                        <?= form_error('subjek'); ?>
                        <div class="validation-message" id="subjek-error" style="display:none;">Silakan isi subjek tiket.</div>
                    </div>

                    <div class="form-group">
                        <label for="prioritas" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-exclamation-triangle mr-2 text-gray-500"></i> Tingkat Prioritas <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select name="prioritas" id="prioritas" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white <?= form_error('prioritas') ? 'is-invalid' : ''; ?>" required>
                            <option value="" disabled <?= empty($prioritas_val) ? 'selected' : ''; ?>>Pilih Prioritas</option>
                            <option value="Rendah" <?= $prioritas_val == 'rendah' ? 'selected' : ''; ?>>Rendah (Low)</option>
                            <option value="Sedang" <?= $prioritas_val == 'sedang' ? 'selected' : ''; ?>>Sedang (Medium)</option>
                            <option value="Tinggi" <?= $prioritas_val == 'tinggi' ? 'selected' : ''; ?>>Tinggi (High)</option>
                            <option value="Urgent" <?= $prioritas_val == 'kritis' ? 'selected' : ''; ?>>Darurat (Critical)</option>
                        </select>
                        <?= form_error('prioritas'); ?>
                        <div class="validation-message" id="prioritas-error" style="display:none;">Silakan pilih tingkat prioritas.</div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-pencil-square mr-2 text-gray-500"></i> Deskripsi <span class="text-red-500 ml-1">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm <?= form_error('deskripsi') ? 'is-invalid' : ''; ?>" rows="4" required placeholder="Jelaskan detail permintaan atau masalah Anda di sini..."><?= html_escape($deskripsi_val); ?></textarea>
                        <?= form_error('deskripsi'); ?>
                        <div class="validation-message" id="deskripsi-error" style="display:none;">Silakan isi deskripsi (minimal 10 karakter).</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="lokasi" class="block text-sm font-semibold text-gray-700 flex items-center">
                                <i class="bi bi-geo-alt mr-2 text-gray-500"></i> Lokasi Terkait <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="lokasi" id="lokasi" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white <?= form_error('lokasi') ? 'is-invalid' : ''; ?>" required>
                                <option value="" disabled <?= empty($lokasi_val) ? 'selected' : ''; ?>>Pilih Lokasi</option>
                                <option value="Gedung A" <?= $lokasi_val == 'gedung_a' ? 'selected' : ''; ?>>Gedung A</option>
                                <option value="Gedung B" <?= $lokasi_val == 'gedung_b' ? 'selected' : ''; ?>>Gedung B</option>
                                <option value="Gedung C" <?= $lokasi_val == 'gedung_c' ? 'selected' : ''; ?>>Gedung C</option>
                                <option value="Perpustakaan" <?= $lokasi_val == 'perpustakaan' ? 'selected' : ''; ?>>Perpustakaan</option>
                                <option value="Laboratorium" <?= $lokasi_val == 'laboratorium' ? 'selected' : ''; ?>>Laboratorium</option>
                                <option value="Aula" <?= $lokasi_val == 'aula' ? 'selected' : ''; ?>>Aula</option>
                                <option value="Auditorium" <?= $lokasi_val == 'auditorium' ? 'selected' : ''; ?>>Auditorium</option>
                                <option value="Kantin" <?= $lokasi_val == 'kantin' ? 'selected' : ''; ?>>Kantin</option>
                                <option value="Masjid" <?= $lokasi_val == 'masjid' ? 'selected' : ''; ?>>Masjid</option>
                                <option value="Parkiran" <?= $lokasi_val == 'parkiran' ? 'selected' : ''; ?>>Area Parkir</option>
                                <option value="Toilet" <?= $lokasi_val == 'toilet' ? 'selected' : ''; ?>>Toilet Umum</option>
                                <option value="Lapangan" <?= $lokasi_val == 'lapangan' ? 'selected' : ''; ?>>Lapangan</option>
                                <option value="Pos Satpam" <?= $lokasi_val == 'pos_satpam' ? 'selected' : ''; ?>>Pos Satpam</option>
                            </select>
                            <?= form_error('lokasi'); ?>
                            <div class="validation-message" id="lokasi-error" style="display:none;">Silakan pilih lokasi.</div>
                        </div>

                        <div class="form-group">
                            <label for="detail_lokasi" class="block text-sm font-semibold text-gray-700 flex items-center">
                                <i class="bi bi-pin-map mr-2 text-gray-500"></i> Detail Lokasi <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" name="detail_lokasi" id="detail_lokasi" value="<?= html_escape($detail_lokasi_val); ?>" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm <?= form_error('detail_lokasi') ? 'is-invalid' : ''; ?>" required placeholder="Contoh: Lantai 3 Ruang 301">
                            <?= form_error('detail_lokasi'); ?>
                            <div class="validation-message" id="detail-lokasi-error" style="display:none;">Silakan isi detail lokasi.</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="tanggal_kejadian" class="block text-sm font-semibold text-gray-700 flex items-center">
                                <i class="bi bi-calendar-event mr-2 text-gray-500"></i> Tanggal Kejadian <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" value="<?= html_escape($tanggal_kejadian_val); ?>" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm <?= form_error('tanggal_kejadian') ? 'is-invalid' : ''; ?>" required>
                            <?= form_error('tanggal_kejadian'); ?>
                            <div class="validation-message" id="tanggal-kejadian-error" style="display:none;">Silakan pilih tanggal kejadian.</div>
                        </div>

                        <div class="form-group">
                            <label for="jadwal_kunjungan" class="block text-sm font-semibold text-gray-700 flex items-center">
                                <i class="bi bi-calendar-check mr-2 text-gray-500"></i> Jadwal Kunjungan yang Diinginkan
                            </label>
                            <input type="datetime-local" name="jadwal_kunjungan" id="jadwal_kunjungan" value="<?= html_escape($jadwal_kunjungan_val); ?>" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm <?= form_error('jadwal_kunjungan') ? 'is-invalid' : ''; ?>">
                            <?= form_error('jadwal_kunjungan'); ?>
                            <div class="text-xs text-gray-500 italic mt-1">Opsional. Isi jika memerlukan kunjungan teknisi.</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center mb-2">
                            <i class="bi bi-camera mr-2 text-gray-500"></i> Lampiran Pendukung (Opsional)
                        </label>
                        <p class="text-gray-600 text-xs italic mb-3">Maks 3 foto (JPG/JPEG, maks 2MB/foto).</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border border-gray-200 p-4 rounded-md bg-gray-50">
                            <div>
                                <label for="upload-foto" class="block text-sm font-medium text-gray-600 mb-1">1. Unggah File</label>
                                <input type="file" name="upload_foto[]" id="upload-foto" accept="image/jpeg, image/jpg" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" aria-label="Unggah Foto" multiple>
                                <p class="text-gray-500 text-xs italic mt-1">Pilih file dari perangkat.</p>
                                <div class="validation-message text-red-500 text-xs mt-1" id="upload-foto-error" style="display:none;"></div>
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

                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-100 rounded-md">
                        <h4 class="font-medium text-sm text-yellow-800 flex items-center">
                            <i class="bi bi-info-circle mr-2"></i> Informasi Tiket
                        </h4>
                        <p class="text-xs text-yellow-700 mt-2">
                            Tiket akan diproses dalam waktu 24 jam kerja. Untuk permasalahan urgensi tinggi, harap tentukan
                            prioritas "Tinggi" atau "Kritis".
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="catatan_tambahan" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="bi bi-sticky mr-2 text-gray-500"></i> Catatan Tambahan
                        </label>
                        <textarea name="catatan_tambahan" id="catatan_tambahan" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" rows="3" placeholder="Informasi tambahan yang perlu diketahui..."><?= html_escape($catatan_tambahan_val); ?></textarea>
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

        const todayInput = document.getElementById('tanggal_kejadian');
        if (!todayInput.value) {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            todayInput.value = `${yyyy}-${mm}-${dd}`;
        }


        let cameraInitialized = false;

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
            cameraElement.innerHTML = '<i class="bi bi-camera-video text-3xl"></i>';

            if (!cameraInitialized) {
                initializeCamera();
            } else {
                if (Webcam && typeof Webcam.attach === 'function' && !Webcam.live) {
                    initializeCamera();
                } else if (Webcam && Webcam.live) {} else {
                    initializeCamera();
                }
            }
        }

        function initializeCamera() {
            try {
                if (Webcam && typeof Webcam.reset === 'function' && Webcam.live) {
                    Webcam.reset();
                }

                Webcam.set({
                    width: 320,
                    height: 240,
                    image_format: 'jpeg',
                    jpeg_quality: 90,
                    flip_horiz: true,
                    constraints: {
                        video: {
                            facingMode: "user",
                            width: {
                                ideal: 320
                            },
                            height: {
                                ideal: 240
                            }
                        },
                        audio: false
                    }
                });

                Webcam.attach(cameraElement);

                Webcam.on('live', function() {
                    cameraInitialized = true;
                    cameraElement.classList.add('video-preview');
                    const placeholderIcon = cameraElement.querySelector('i');
                    if (placeholderIcon) placeholderIcon.style.display = 'none';
                });

                Webcam.on('error', function(err) {
                    console.error("Webcam Error:", err);
                    let errorMessage = `Gagal mengakses kamera. Pastikan:<br>
                                      1. Izin kamera sudah diberikan untuk situs ini.<br>
                                      2. Tidak ada aplikasi lain yang menggunakan kamera.<br>`;
                    if (typeof err === 'string') {
                        if (err.includes('NotFoundError') || err.includes('NotAllowedError')) {
                            errorMessage = 'Kamera tidak ditemukan atau izin tidak diberikan.';
                        } else if (err.includes('NotReadableError')) {
                            errorMessage = 'Kamera sedang digunakan oleh aplikasi lain atau ada masalah hardware.';
                        }
                    } else if (err.name) {
                        if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                            errorMessage = 'Kamera tidak ditemukan. Pastikan kamera terhubung dan driver terinstal.';
                        } else if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                            errorMessage = 'Akses ke kamera ditolak. Mohon berikan izin pada browser Anda.';
                        } else if (err.name === 'NotReadableError' || err.name === 'TrackStartError') {
                            errorMessage = 'Kamera tidak dapat diakses, mungkin sedang digunakan oleh aplikasi lain atau ada masalah hardware.';
                        }
                    }
                    showValidationError('upload-foto-error', errorMessage);
                    cancelCamera(false);
                    cameraInitialized = false;
                });
            } catch (e) {
                console.error("Camera initialization error:", e);
                showValidationError('upload-foto-error', `Error inisialisasi kamera: ${e.message || 'Unknown Error'}`);
                cancelCamera(false);
                cameraInitialized = false;
            }
        }

        window.takeSnapshot = function() {
            if (getTotalFilesCount() >= MAX_FILES) {
                showValidationError('upload-foto-error', `Batas maksimal ${MAX_FILES} foto tercapai.`);
                cancelCamera();
                return;
            }
            clearValidationError('upload-foto-error');

            try {
                if (!Webcam.live) {
                    showValidationError('upload-foto-error', 'Kamera tidak aktif. Silakan coba buka kamera kembali.');
                    return;
                }

                Webcam.snap(function(data_uri) {
                    const imageName = `capture_${Date.now()}.jpg`;
                    const blob = dataURItoBlob(data_uri);

                    if (!blob) {
                        showValidationError('upload-foto-error', 'Gagal mengambil gambar dari kamera.');
                        return;
                    }

                    if (blob.size > MAX_FILE_SIZE_BYTES) {
                        showValidationError('upload-foto-error', `Foto dari kamera (${(blob.size / 1024 / 1024).toFixed(1)} MB) melebihi ukuran maksimal ${MAX_FILE_SIZE_MB} MB.`);
                        return;
                    }

                    const file = new File([blob], imageName, {
                        type: 'image/jpeg'
                    });
                    addFileToCollectionAndPreview(file);
                });
                cancelCamera();
            } catch (e) {
                console.error("Snapshot error:", e);
                showValidationError('upload-foto-error', `Error saat mengambil foto: ${e.message || 'Unknown Error'}`);
            }
        };

        window.cancelCamera = function(clearError = true) {
            if (Webcam && typeof Webcam.reset === 'function' && Webcam.live) {
                Webcam.reset();
            }
            cameraContainer.classList.add('hidden');
            openCameraBtn.classList.remove('hidden');
            cameraElement.innerHTML = '<i class="bi bi-camera-video text-3xl"></i>';
            if (clearError) {
                clearValidationError('upload-foto-error');
            }
        };


        function dataURItoBlob(dataURI) {
            try {
                let byteString;
                if (dataURI.split(',')[0].indexOf('base64') >= 0) {
                    byteString = atob(dataURI.split(',')[1]);
                } else {
                    byteString = unescape(dataURI.split(',')[1]);
                }
                const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
                const ia = new Uint8Array(byteString.length);
                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                return new Blob([ia], {
                    type: mimeString
                });
            } catch (e) {
                console.error("Failed to convert data URI to Blob:", e);
                showValidationError('upload-foto-error', 'Gagal memproses gambar dari kamera.');
                return null;
            }
        }

        function handleFiles(fileList) {
            if (!fileList || fileList.length === 0) return;

            let filesAddedThisTime = 0;
            let errors = [];
            clearValidationError('upload-foto-error');

            Array.from(fileList).forEach(file => {
                if (getTotalFilesCount() + filesAddedThisTime >= MAX_FILES) {
                    if (!errors.includes(`Batas maksimal ${MAX_FILES} foto tercapai.`)) {
                        errors.push(`Batas maksimal ${MAX_FILES} foto tercapai.`);
                    }
                    return;
                }

                if (!ALLOWED_TYPES.includes(file.type)) {
                    errors.push(`Format file tidak sesuai (${escapeHtml(file.name)}). Hanya .jpg/.jpeg yang diperbolehkan.`);
                    return;
                }

                if (file.size > MAX_FILE_SIZE_BYTES) {
                    errors.push(`File '${escapeHtml(file.name)}' (${(file.size / 1024 / 1024).toFixed(1)} MB) melebihi ukuran ${MAX_FILE_SIZE_MB} MB.`);
                    return;
                }

                let isDuplicate = false;
                for (let i = 0; i < uploadedFilesData.files.length; i++) {
                    if (uploadedFilesData.files[i].name === file.name && uploadedFilesData.files[i].size === file.size) {
                        isDuplicate = true;
                        break;
                    }
                }
                if (isDuplicate) {
                    errors.push(`File '${escapeHtml(file.name)}' sudah ditambahkan.`);
                    return;
                }


                addFileToCollection(file);
                addPreviewImage(file);
                filesAddedThisTime++;
            });

            if (errors.length > 0) {
                showValidationError('upload-foto-error', errors.join('<br>'));
            }
            uploadFotoInput.files = uploadedFilesData.files;
            updateFileNameDisplay();
        }

        function addFileToCollectionAndPreview(file) {
            if (getTotalFilesCount() >= MAX_FILES) {
                showValidationError('upload-foto-error', `Batas maksimal ${MAX_FILES} foto tercapai.`);
                return;
            }
            let isDuplicate = false;
            for (let i = 0; i < uploadedFilesData.files.length; i++) {
                if (uploadedFilesData.files[i].name === file.name && uploadedFilesData.files[i].size === file.size) {
                    isDuplicate = true;
                    break;
                }
            }
            if (isDuplicate) {
                showValidationError('upload-foto-error', `File '${escapeHtml(file.name)}' sudah ditambahkan.`);
                return;
            }

            addFileToCollection(file);
            addPreviewImage(file);
            uploadFotoInput.files = uploadedFilesData.files;
            updateFileNameDisplay();
        }


        function addFileToCollection(file) {
            uploadedFilesData.items.add(file);
        }

        function addPreviewImage(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (noPreviewText) noPreviewText.style.display = 'none';

                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative w-20 h-20 group';
                imgContainer.dataset.filename = file.name;

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover rounded border border-gray-300';
                img.alt = escapeHtml(file.name);

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'remove-image-btn opacity-0 group-hover:opacity-100 transition-opacity';
                removeBtn.innerHTML = '×';
                removeBtn.title = 'Hapus gambar';
                removeBtn.addEventListener('click', function() {
                    removeFile(file.name);
                    imgContainer.remove();
                    if (previewImages.querySelectorAll('.relative').length === 0 && noPreviewText) {
                        noPreviewText.style.display = '';
                    }
                    updateFileNameDisplay();
                });

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                previewImages.appendChild(imgContainer);
            };
            reader.onerror = function() {
                console.error('FileReader error', reader.error);
                showValidationError('upload-foto-error', `Error membaca file '${escapeHtml(file.name)}'.`);
            };
            reader.readAsDataURL(file);
        }

        function removeFile(filename) {
            const newDataTransfer = new DataTransfer();
            Array.from(uploadedFilesData.files).forEach(file => {
                if (file.name !== filename) {
                    newDataTransfer.items.add(file);
                }
            });
            uploadedFilesData = newDataTransfer;
            uploadFotoInput.files = uploadedFilesData.files;
        }

        function updateFileNameDisplay() {
            const files = uploadedFilesData.files;
            previewFileNames.innerHTML = '';

            if (files.length > 0) {
                const fileInfoList = document.createElement('ul');
                fileInfoList.className = 'list-disc pl-5 space-y-1 text-xs';

                Array.from(files).forEach(file => {
                    const li = document.createElement('li');
                    li.textContent = `${escapeHtml(file.name)} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                    fileInfoList.appendChild(li);
                });
                previewFileNames.appendChild(fileInfoList);
            }

            const fileNamesInfoElement = document.getElementById('file-names-info');
            if (fileNamesInfoElement) {
                fileNamesInfoElement.textContent =
                    files.length > 0 ? `${files.length} file dipilih. ${files.length < MAX_FILES ? `Anda dapat menambahkan ${MAX_FILES - files.length} file lagi.` : 'Batas maksimal file tercapai.'}` : 'Belum ada file dipilih.';
            }
        }


        function getTotalFilesCount() {
            return uploadedFilesData.files.length;
        }

        function showValidationError(elementId, message, isFieldInvalid = false, fieldElement = null) {
            const errorElement = document.getElementById(elementId);
            const inputField = fieldElement || (errorElement ? errorElement.previousElementSibling : null);

            if (errorElement) {
                errorElement.innerHTML = message;
                errorElement.style.display = 'block';
            }
            if (isFieldInvalid && inputField && typeof inputField.classList !== 'undefined') {
                inputField.classList.add('is-invalid');
            }
        }

        function clearValidationError(elementId) {
            const errorElement = document.getElementById(elementId);
            const inputField = errorElement ? errorElement.previousElementSibling : null;

            if (errorElement) {
                errorElement.innerHTML = '';
                errorElement.style.display = 'none';
            }
            if (inputField && typeof inputField.classList !== 'undefined') {
                if (!elementId.includes('upload-foto')) {
                    inputField.classList.remove('is-invalid');
                }
            }
        }

        function handleFormSubmit(event) {
            let isValid = true;
            let firstErrorField = null;

            document.querySelectorAll('.validation-message').forEach(el => {
                el.style.display = 'none';
                const field = el.previousElementSibling;
                if (field && field.classList) field.classList.remove('is-invalid');
            });
            clearValidationError('upload-foto-error');


            const requiredFields = {
                'kategori': {
                    errorId: 'kategori-error',
                    message: 'Kategori layanan harus dipilih.'
                },
                'subjek': {
                    errorId: 'subjek-error',
                    message: 'Subjek tiket harus diisi.'
                },
                'prioritas': {
                    errorId: 'prioritas-error',
                    message: 'Tingkat prioritas harus dipilih.'
                },
                'deskripsi': {
                    errorId: 'deskripsi-error',
                    message: 'Deskripsi harus diisi.'
                },
                'lokasi': {
                    errorId: 'lokasi-error',
                    message: 'Lokasi terkait harus dipilih.'
                },
                'detail_lokasi': {
                    errorId: 'detail-lokasi-error',
                    message: 'Detail lokasi harus diisi.'
                },
                'tanggal_kejadian': {
                    errorId: 'tanggal-kejadian-error',
                    message: 'Tanggal kejadian harus dipilih.'
                }
            };

            Object.entries(requiredFields).forEach(([fieldId, config]) => {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    showValidationError(config.errorId, config.message, true, field);
                    isValid = false;
                    if (!firstErrorField) firstErrorField = field;
                }
            });

            const emailField = document.getElementById('email');
            if (emailField.value.trim() && !isValidEmail(emailField.value.trim())) {
                showValidationError('email-error', 'Format email tidak valid.', true, emailField);
                isValid = false;
                if (!firstErrorField) firstErrorField = emailField;
            }

            const deskripsiField = document.getElementById('deskripsi');
            if (deskripsiField.value.trim() && deskripsiField.value.trim().length < 10) {
                showValidationError('deskripsi-error', 'Deskripsi minimal 10 karakter.', true, deskripsiField);
                isValid = false;
                if (!firstErrorField) firstErrorField = deskripsiField;
            }

            if (uploadedFilesData.files.length > MAX_FILES) {
                showValidationError('upload-foto-error', `Anda hanya dapat mengunggah maksimal ${MAX_FILES} file.`);
                isValid = false;
                if (!firstErrorField) firstErrorField = uploadFotoInput;
            }
            Array.from(uploadedFilesData.files).forEach(file => {
                if (!ALLOWED_TYPES.includes(file.type)) {
                    showValidationError('upload-foto-error', `File '${escapeHtml(file.name)}' memiliki format yang tidak diizinkan.`);
                    isValid = false;
                    if (!firstErrorField) firstErrorField = uploadFotoInput;
                }
                if (file.size > MAX_FILE_SIZE_BYTES) {
                    showValidationError('upload-foto-error', `File '${escapeHtml(file.name)}' melebihi batas ukuran ${MAX_FILE_SIZE_MB}MB.`);
                    isValid = false;
                    if (!firstErrorField) firstErrorField = uploadFotoInput;
                }
            });


            if (!isValid) {
                event.preventDefault();
                if (firstErrorField) {
                    firstErrorField.focus();
                    const firstVisibleError = document.querySelector('.validation-message[style*="display: block"]');
                    if (firstVisibleError) {
                        firstVisibleError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }



            } else {
                uploadFotoInput.files = uploadedFilesData.files;

                const submitButton = document.getElementById('submit-button');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="bi bi-hourglass-split mr-2 animate-spin"></i> Mengirim...';
            }
        }

        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function escapeHtml(unsafe) {
            if (typeof unsafe !== 'string') return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        updateFileNameDisplay();

    });
</script>

<?php $this->load->view('layout/footer'); ?>