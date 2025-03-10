<?php $this->load->view('layout/header'); ?> <br>
<link rel="stylesheet" href="./assets/css/main_page.css">

<body class="bg-gray-100">
    <div class="w-4/5 mx-auto flex flex-wrap justify-center gap-6 mb-20 mt-20">
        <!-- Lost and Found -->
        <div class="w-80 bg-white shadow-lg rounded-lg overflow-hidden">
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
        <div class="w-80 bg-white shadow-lg rounded-lg overflow-hidden">
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
        <div class="w-80 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">E-Permit</h2>
                <p class="text-gray-600">Pengajuan izin dan permohonan khusus.</p>
            </div>
            <div class="px-6 py-4 bg-gray-100 flex justify-center">
                <button class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900 w-full sm:w-auto">Ajukan Izin</button>
            </div>
        </div>
    </div>
    <div class="news w-full mx-auto bg-gray-200 p-20">
        <h2 class="font-bold text-2xl mb-10">Berita</h2>
        <div class="p-2 mb-10">
            <span>Author</span><br>
            <span class="text-gray-500 text-sm">01 Maret 2025</span>
            <span class="font-bold"> - Kehilangan Motor</span>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente eveniet laudantium sit maiores ipsam pariatur, animi incidunt! Id corporis sit alias hic a? Officiis iste error fugit, quibusdam veniam animi rerum atque alias voluptas esse et reprehenderit exercitationem deserunt ducimus maxime voluptate natus dolorum rem, amet dolorem qui facere sequi? Dolore adipisci reiciendis dolorem atque eaque molestiae minima, magnam maxime! Cupiditate alias iusto voluptatibus at enim excepturi ipsum suscipit consectetur omnis numquam voluptatum, deleniti vitae amet, tempore modi accusantium exercitationem tempora optio iste inventore id. Repellat quasi quod ab ad explicabo aliquam porro molestiae iste? Odit dolorum impedit rerum sequi!</p>
        </div>
        <div class="p-2 mb-10">
            <span>Author</span><br>
            <span class="text-gray-500 text-sm">01 Maret 2025</span>
            <span class="font-bold"> - Kehilangan Motor</span>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente eveniet laudantium sit maiores ipsam pariatur, animi incidunt! Id corporis sit alias hic a? Officiis iste error fugit, quibusdam veniam animi rerum atque alias voluptas esse et reprehenderit exercitationem deserunt ducimus maxime voluptate natus dolorum rem, amet dolorem qui facere sequi? Dolore adipisci reiciendis dolorem atque eaque molestiae minima, magnam maxime! Cupiditate alias iusto voluptatibus at enim excepturi ipsum suscipit consectetur omnis numquam voluptatum, deleniti vitae amet, tempore modi accusantium exercitationem tempora optio iste inventore id. Repellat quasi quod ab ad explicabo aliquam porro molestiae iste? Odit dolorum impedit rerum sequi!</p>
        </div>
        <div class="p-2 mb-10">
            <span>Author</span><br>
            <span class="text-gray-500 text-sm">01 Maret 2025</span>
            <span class="font-bold"> - Kehilangan Motor</span>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente eveniet laudantium sit maiores ipsam pariatur, animi incidunt! Id corporis sit alias hic a? Officiis iste error fugit, quibusdam veniam animi rerum atque alias voluptas esse et reprehenderit exercitationem deserunt ducimus maxime voluptate natus dolorum rem, amet dolorem qui facere sequi? Dolore adipisci reiciendis dolorem atque eaque molestiae minima, magnam maxime! Cupiditate alias iusto voluptatibus at enim excepturi ipsum suscipit consectetur omnis numquam voluptatum, deleniti vitae amet, tempore modi accusantium exercitationem tempora optio iste inventore id. Repellat quasi quod ab ad explicabo aliquam porro molestiae iste? Odit dolorum impedit rerum sequi!</p>
        </div>
        <div class="view-all text-center">
            <span class="text-gray-500 cursor-pointer">Lihat semua</span>
        </div>
    </div>

</body>
<?php $this->load->view('layout/footer'); ?>