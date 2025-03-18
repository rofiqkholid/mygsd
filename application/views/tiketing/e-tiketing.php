<?php $this->load->view('layout/header'); ?> <br>
<style>
    select {
        -webkit-appearance: none;
        /* Untuk Safari dan Chrome */
        -moz-appearance: none;
        /* Untuk Firefox */
        appearance: none;
        /* Untuk browser lainnya */
    }

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

    <div class="my-4">
        <label for="kategori" class="block font-medium">Kategori Pengaduan</label>
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
            <option value="pengaduan_sampah">Pengaduan Sampah Menumpuk</option>
            <option value="laporan_kerusakan">Laporan Kerusakan di Area Kampus</option>
        </select>
        <div class="text-red-500 text-sm hidden">Silakan pilih kategori pengaduan.</div>
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="block font-medium">Deskripsi Masalah</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded mt-2" rows="4" required></textarea>
        <div class="text-red-500 text-sm hidden">Silakan isi deskripsi minimal 10 karakter.</div>
    </div>

    <div class="mb-4">
        <label for="lokasi" class="block font-medium">Lokasi Kejadian, Ruangan dan lain-lain.</label>
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
        <label for="foto" class="block font-medium">Upload Foto (Opsional)</label>
        <input type="file" name="foto" class="w-full p-2 border rounded mt-2">
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