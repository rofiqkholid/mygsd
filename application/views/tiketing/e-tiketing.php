<?php $this->load->view('layout/header'); ?> <br>
<style>
    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
            display: flexbox;
            justify-content: center;
        }
    }
</style>
<div class="form-container mt-20 px-40">
    <h2 class="mb-4 text-2xl font-bold">Form Pengaduan</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="p-4 mb-4 text-green-800 bg-green-200 rounded"> <?= $this->session->flashdata('success'); ?> </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="p-4 mb-4 text-red-800 bg-red-200 rounded"> <?= $this->session->flashdata('error'); ?> </div>
    <?php endif; ?>

    <?= form_open_multipart('pengaduan/submit', ['class' => 'needs-validation', 'novalidate' => '']); ?>

    <div class="mb-4">
        <label for="kategori" class="block font-medium">Kategori Pengaduan</label>
        <select name="kategori" class="w-full p-2 border rounded" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori_pengaduan as $kategori => $subkategori): ?>
                <optgroup label="<?= $kategori; ?>">
                    <?php foreach ($subkategori as $item): ?>
                        <option value="<?= $item; ?>"> <?= $item; ?> </option>
                    <?php endforeach; ?>
                </optgroup>
            <?php endforeach; ?>
        </select>
        <div class="text-red-500 text-sm hidden">Silakan pilih kategori pengaduan.</div>
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="block font-medium">Deskripsi Masalah</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded" rows="4" required></textarea>
        <div class="text-red-500 text-sm hidden">Silakan isi deskripsi minimal 10 karakter.</div>
    </div>

    <div class="mb-4">
        <label for="lokasi" class="block font-medium">Lokasi Kejadian</label>
        <select name="lokasi" class="w-full p-2 border rounded" required>
            <option value="">Pilih Lokasi</option>
            <?php foreach ($lokasi as $l): ?>
                <option value="<?= $l; ?>"> <?= $l; ?> </option>
            <?php endforeach; ?>
        </select>
        <div class="text-red-500 text-sm hidden">Silakan pilih lokasi kejadian.</div>
    </div>

    <div class="mb-4">
        <label for="foto" class="block font-medium">Upload Foto (Opsional)</label>
        <input type="file" name="foto" class="w-full p-2 border rounded">
        <small class="text-gray-500">Format: JPG, PNG (Max 2MB)</small>
    </div>

    <button type="submit" class="w-50 bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Kirim Pengaduan</button>

    <?= form_close(); ?>

    <script>
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
    
</div>