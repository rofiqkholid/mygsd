<?php $this->load->view('layout/header'); ?>
<?php
$id_user = isset($_SESSION['id_user']);
?>
<body class="bg-gray-100 font-sans antialiased text-gray-800">

    <div class="container mx-auto px-4 py-16 sm:px-6 lg:py-20 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:scale-[1.01]">
                <div class="p-6 flex-grow">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-600 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">Lost and Found</h2>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Laporan barang hilang dan layanan penemuan kembali barang Anda.</p>
                </div>
                <div class="px-6 pb-6 pt-2 flex flex-col sm:flex-row justify-between gap-3"><a href="<?= site_url('found'); ?>" class="w-full sm:w-auto">
                        <button class="w-full sm:w-auto px-4 py-2 rounded-md text-sm font-medium border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Lapor Temuan
                        </button>

                    </a>
                    <a href="<?= base_url('found/detail_found/' . $id_user); ?>"
                        <button class="w-full sm:w-auto px-4 py-2 rounded-md text-sm font-medium bg-red-600 text-white hover:bg-red-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Detail Laporan Penemuan
                        </button>
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:scale-[1.01]">
                <div class="p-6 flex-grow">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-green-600 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">E-Tiketing</h2>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Sistem pelaporan keluhan dan pemantauan tiket elektronik Anda.</p>
                </div>
                <div class="px-6 pb-6 pt-2 flex justify-end"> <a href="<?= site_url('tiketing'); ?>" class="w-full sm:w-auto">
                        <button class="w-full px-4 py-2 rounded-md text-sm font-medium bg-red-600 text-white hover:bg-red-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Ajukan Tiket
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-12">
        <?php if (empty($news)): ?>
            <div class="bg-white shadow-md rounded-lg p-10 text-center">
                <div class="flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Belum ada berita penemuan barang saat ini.</h3>
            </div>
        <?php else: ?>
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 pb-2 border-b-2 border-blue-600">Berita Penemuan Barang</h2>

                    <div class="space-y-8">
                        <?php foreach ($news as $index => $item): ?>
                            <article class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-lg hover:border-gray-200 flex flex-col">
                                <div class="flex flex-col md:flex-row">
                                    <?php if (!empty($item['attachments'])): ?>
                                        <?php
                                        $attachment_path = base_url('uploads/found/' . $item['attachments']);
                                        $file_extension = strtolower(pathinfo($item['attachments'], PATHINFO_EXTENSION));
                                        $modal_id = 'modal-' . $item['id_found'];
                                        if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                            <div class="md:w-1/3 bg-gray-100 flex items-center justify-center p-4">
                                                <button
                                                    onclick="document.getElementById('<?php echo $modal_id; ?>').classList.remove('hidden')"
                                                    class="relative w-full h-48 overflow-hidden rounded-lg hover:opacity-90 transition-opacity">
                                                    <img src="<?php echo $attachment_path; ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                                        <div class="bg-white bg-opacity-80 rounded-full p-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-800">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>

                                                <div id="<?php echo $modal_id; ?>" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
                                                    <div class="bg-white rounded-lg max-w-4xl w-full overflow-hidden shadow-xl">
                                                        <div class="p-4 flex justify-between items-center border-b">
                                                            <h3 class="text-lg font-medium text-gray-800">
                                                                <?php echo htmlspecialchars($item['item_name']); ?>
                                                            </h3>
                                                            <button
                                                                onclick="document.getElementById('<?php echo $modal_id; ?>').classList.add('hidden')"
                                                                class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="p-4">
                                                            <img src="<?php echo $attachment_path; ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" class="w-full object-contain max-h-[70vh]">
                                                        </div>
                                                        <div class="bg-gray-50 p-4 text-right">
                                                            <button
                                                                onclick="document.getElementById('<?php echo $modal_id; ?>').classList.add('hidden')"
                                                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 focus:outline-none transition-colors">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="md:w-1/3 bg-gray-50 flex items-center justify-center p-6">
                                                <a href="<?php echo $attachment_path; ?>" target="_blank" class="flex flex-col items-center hover:opacity-80 transition-opacity">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-600 mb-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                    <span class="text-blue-600 font-medium">Lihat Lampiran</span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <div class="<?php echo !empty($item['attachments']) ? 'md:w-2/3' : 'w-full'; ?> flex flex-col">
                                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                                            <h3 class="text-xl font-bold text-gray-800 truncate">
                                                <?php echo htmlspecialchars($item['item_name']); ?>
                                            </h3>
                                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <?php echo htmlspecialchars($item['status']); ?>
                                            </span>
                                        </div>

                                        <div class="p-6 flex-grow">
                                            <div class="mb-6">
                                                <h4 class="text-sm uppercase tracking-wider text-gray-500 mb-2 font-semibold">Deskripsi</h4>
                                                <p class="text-gray-700"><?php echo htmlspecialchars($item['description']); ?></p>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div class="flex items-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm text-gray-500 font-medium">Lokasi Ditemukan</p>
                                                        <p class="text-gray-700"><?php echo htmlspecialchars($item['location_found']); ?></p>
                                                    </div>
                                                </div>

                                                <div class="flex items-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm text-gray-500 font-medium">Tanggal & Waktu</p>
                                                        <p class="text-gray-700">
                                                            <?php
                                                            $date = new DateTime($item['found_date'] . ' ' . $item['found_time']);
                                                            echo $date->format('d M Y H:i');
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="flex items-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm text-gray-500 font-medium">Dilaporkan oleh</p>
                                                        <p class="text-gray-700"><?php echo htmlspecialchars($item['reporter_name']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 mt-auto">
                                            <div class="flex flex-wrap justify-between items-center gap-4">
                                                <p class="text-xs text-gray-500 italic">*Status <span class="underline">karantina</span> berarti barang telah diserahkan ke petugas keamanan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>

</body>

<?php $this->load->view('layout/footer'); ?>