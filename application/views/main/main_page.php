<?php $this->load->view('layout/header'); ?>

<body class="bg-gray-100 font-sans antialiased text-gray-800">

    <div class="container mx-auto px-4 py-16 sm:px-6 lg:py-20 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:scale-[1.01]"> <div class="p-6 flex-grow">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-600 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">Lost and Found</h2>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Laporan barang hilang dan layanan penemuan kembali barang Anda.</p> </div>
                <div class="px-6 pb-6 pt-2 flex flex-col sm:flex-row justify-between gap-3">
                    <button class="w-full sm:w-auto px-4 py-2 rounded-md text-sm font-medium border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lapor Temuan
                    </button>
                    <button class="w-full sm:w-auto px-4 py-2 rounded-md text-sm font-medium bg-red-600 text-white hover:bg-red-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Cari Barang Hilang
                    </button>
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

            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:scale-[1.01]">
                <div class="p-6 flex-grow">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-yellow-600 mr-3">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                         </svg>
                        <h2 class="text-lg font-semibold text-gray-900">E-Permit</h2>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Pengajuan izin masuk, keluar, atau kegiatan khusus lainnya secara online.</p>
                </div>
                 <div class="px-6 pb-6 pt-2 flex justify-end"> <button class="w-full sm:w-auto px-4 py-2 rounded-md text-sm font-medium bg-red-600 text-white hover:bg-red-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Ajukan Izin
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white py-16 sm:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-12 text-center">Berita & Informasi</h2> <div class="space-y-12"> <article> <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 mb-3 text-sm text-gray-500">
                        <div class="inline-flex items-center mb-1 sm:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <span class="font-medium text-indigo-600 hover:text-indigo-800 transition duration-150">Nama Author</span>
                        </div>
                         <span class="hidden sm:inline text-gray-400">&bull;</span>
                        <div class="inline-flex items-center">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            01 Maret 2025
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3 group">
                        <a href="#" class="hover:text-red-700 transition duration-150">
                            Kehilangan Motor di Area Parkir Utara
                             <span class="inline-block text-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-150 ml-1">&rarr;</span>
                        </a>
                    </h3>
                    <p class="text-gray-600 text-base leading-relaxed line-clamp-3 mb-4">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente eveniet laudantium sit maiores ipsam pariatur, animi incidunt! Id corporis sit alias hic a? Officiis iste error fugit, quibusdam veniam animi rerum atque alias voluptas esse et reprehenderit exercitationem deserunt ducimus maxime voluptate natus dolorum rem...
                    </p>
                     <a href="#" class="text-sm text-red-600 hover:text-red-800 font-medium transition duration-150 ease-in-out inline-flex items-center group">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-1 transition-transform duration-150 ease-in-out group-hover:translate-x-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                     <hr class="mt-10 border-gray-200"> </article>

                <article>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 mb-3 text-sm text-gray-500">
                         <div class="inline-flex items-center mb-1 sm:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5"> <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /> </svg>
                            <span class="font-medium text-indigo-600 hover:text-indigo-800 transition duration-150">Author Lain</span>
                        </div>
                         <span class="hidden sm:inline text-gray-400">&bull;</span>
                        <div class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5"> <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" /> </svg>
                            01 Maret 2025
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3 group">
                         <a href="#" class="hover:text-red-700 transition duration-150">
                            Pembaruan Sistem E-Permit Mulai Minggu Depan
                             <span class="inline-block text-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-150 ml-1">&rarr;</span>
                        </a>
                    </h3>
                    <p class="text-gray-600 text-base leading-relaxed line-clamp-3 mb-4">
                         Sapiente eveniet laudantium sit maiores ipsam pariatur, animi incidunt! Id corporis sit alias hic a? Officiis iste error fugit, quibusdam veniam animi rerum atque alias voluptas esse et reprehenderit exercitationem deserunt ducimus maxime voluptate natus dolorum rem, amet dolorem qui facere sequi? Dolore adipisci reiciendis dolorem atque...
                    </p>
                     <a href="#" class="text-sm text-red-600 hover:text-red-800 font-medium transition duration-150 ease-in-out inline-flex items-center group">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-1 transition-transform duration-150 ease-in-out group-hover:translate-x-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" /> </svg>
                    </a>
                     <hr class="mt-10 border-gray-200"> </article>

                <article>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 mb-3 text-sm text-gray-500">
                         <div class="inline-flex items-center mb-1 sm:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5"> <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /> </svg>
                            <span class="font-medium text-indigo-600 hover:text-indigo-800 transition duration-150">Admin Web</span>
                        </div>
                         <span class="hidden sm:inline text-gray-400">&bull;</span>
                         <div class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5"> <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" /> </svg>
                            28 Februari 2025
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3 group">
                         <a href="#" class="hover:text-red-700 transition duration-150">
                            Tips Keamanan: Selalu Kunci Ganda Kendaraan Anda
                            <span class="inline-block text-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-150 ml-1">&rarr;</span>
                        </a>
                    </h3>
                    <p class="text-gray-600 text-base leading-relaxed line-clamp-3 mb-4">
                        Id corporis sit alias hic a? Officiis iste error fugit, quibusdam veniam animi rerum atque alias voluptas esse et reprehenderit exercitationem deserunt ducimus maxime voluptate natus dolorum rem, amet dolorem qui facere sequi? Dolore adipisci reiciendis dolorem atque eaque molestiae minima, magnam maxime! Cupiditate alias iusto voluptatibus...
                    </p>
                     <a href="#" class="text-sm text-red-600 hover:text-red-800 font-medium transition duration-150 ease-in-out inline-flex items-center group">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-1 transition-transform duration-150 ease-in-out group-hover:translate-x-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" /> </svg>
                    </a>
                     </article>

            </div>

            <div class="mt-16 text-center"> <a href="#" class="inline-block bg-gray-800 text-white px-6 py-3 rounded-md text-base font-medium hover:bg-gray-900 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                    Lihat Arsip Berita
                </a>
            </div>
        </div>
    </div>

</body>

<?php $this->load->view('layout/footer'); ?>