
<head>
    <title>MyGSD - Dashboard Monitoring</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="bg-gray-200 flex">
<?php $this->load->view('layout/sidebar'); ?>

    <div id="content" class="content w-full p-6 ml-[5rem]">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">General Service Division Dashboard Monitoring</h1>

        <!-- Bagian Teratas -->
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            <?php
            $topCards = [
                ["Tiket Masuk", 65, "bg-blue-800", "bi-ticket-fill"],
                ["Total Penemuan", 23, "bg-green-600", "bi-search"],
                ["Total Perizinan", 226, "bg-yellow-600", "bi-file-earmark-check"]
            ];

            foreach ($topCards as $item) {
                echo '
                    <div class="glass-card ' . $item[2] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                        <i class="' . $item[3] . ' text-4xl mb-2"></i>
                        <h2 class="text-lg font-semibold">' . $item[0] . '</h2>
                        <span class="text-4xl font-bold mt-2">' . $item[1] . '</span>
                    </div>';
            }
            ?>
        </div>

        <!-- Section Tiket -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Tiket</h2>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-6">
                <?php
                $tiketData = [
                    ["Tiket dalam Proses", 2, "bg-blue-800", "bi-hourglass-split"],
                    ["Tiket di Tolak", 2, "bg-blue-800", "bi-x-circle"],
                    ["Tiket di Setujui", 2, "bg-blue-800", "bi-check-circle"],
                    ["Tiket Selesai", 63, "bg-blue-800", "bi-clipboard-check"]
                ];

                foreach ($tiketData as $item) {
                    echo '
                        <div class="glass-card ' . $item[2] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                            <i class="' . $item[3] . ' text-4xl mb-2"></i>
                            <h2 class="text-lg font-semibold">' . $item[0] . '</h2>
                            <span class="text-4xl font-bold mt-2">' . $item[1] . '</span>
                        </div>';
                }
                ?>
            </div>
        </div>

        <!-- Section Kehilangan & Penemuan -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Kehilangan dan Penemuan Barang</h2>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <?php
                $penemuanData = [
                    ["Total Kehilangan", 23, "bg-green-600", "bi-box"],
                    ["Total Klaim", 20, "bg-green-600", "bi-check-square"],
                    ["Karantina", 3, "bg-green-600", "bi-lock"]
                ];

                foreach ($penemuanData as $item) {
                    echo '
                        <div class="glass-card ' . $item[2] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                            <i class="' . $item[3] . ' text-4xl mb-2"></i>
                            <h2 class="text-lg font-semibold">' . $item[0] . '</h2>
                            <span class="text-4xl font-bold mt-2">' . $item[1] . '</span>
                        </div>';
                }
                ?>
            </div>
        </div>

        <!-- Section Perizinan -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Perizinan</h2>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <?php
                $izinData = [
                    ["Izin di Tolak", 26, "bg-yellow-600", "bi-x-octagon"],
                    ["Izin di Setujui", 200, "bg-yellow-600", "bi-check-circle"],
                    ["Izin di Pending", 0, "bg-yellow-600", "bi-hourglass"]
                ];

                foreach ($izinData as $item) {
                    echo '
                        <div class="glass-card ' . $item[2] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                            <i class="' . $item[3] . ' text-4xl mb-2"></i>
                            <h2 class="text-lg font-semibold">' . $item[0] . '</h2>
                            <span class="text-4xl font-bold mt-2">' . $item[1] . '</span>
                        </div>';
                }
                ?>
            </div>
        </div>
        <br><br>
    </div>
</body>

</html>