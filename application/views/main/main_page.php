<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGSD - Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/main_page.css">
</head>
<body class="bg-gray-100 min-h-screen">
<?php $this->load->view('layout/header'); ?> <br><br><br>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Lost and Found -->
        <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Lost and Found</h2>
                <p class="text-gray-600">Laporan barang hilang dan ditemukan.</p>
            </div>
            <div class="px-6 py-4 bg-gray-100 flex flex-col sm:flex-row justify-between gap-2">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full sm:w-auto">Laporkan</button>
                <button class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900 w-full sm:w-auto">Cari Barang</button>
            </div>
        </div>

        <!-- E-Tiket -->
        <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">E-Tiket</h2>
                <p class="text-gray-600">Pelaporan dan pemantauan tiket elektronik.</p>
            </div>
            <div class="px-6 py-4 bg-gray-100 flex flex-col sm:flex-row justify-between gap-2">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full sm:w-auto">Laporkan</button>
                <button class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900 w-full sm:w-auto">Cari Tiket</button>
            </div>
        </div>

        <!-- E-Permit -->
        <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">E-Permit</h2>
                <p class="text-gray-600">Pengajuan izin dan permohonan khusus.</p>
            </div>
            <div class="px-6 py-4 bg-gray-100 flex justify-center">
                <button class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900 w-full sm:w-auto">Ajukan Izin</button>
            </div>
        </div>
    </div>
</body>

</html>
