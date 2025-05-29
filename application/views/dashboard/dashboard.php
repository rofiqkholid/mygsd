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
            if (isset($topCards) && is_array($topCards)) {
                foreach ($topCards as $item) {
                    echo '
                        <div class="glass-card ' . $item[2] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                            <i class="' . $item[3] . ' text-4xl mb-2"></i>
                            <h2 class="text-lg font-semibold">' . $item[0] . '</h2>
                            <span class="text-4xl font-bold mt-2">' . $item[1] . '</span>
                        </div>';
                }
            }
            ?>
        </div>

        <!-- Section Tiket -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Tiket</h2>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-6">
                <?php
                if (isset($tiketData) && is_array($tiketData)) {
                    foreach ($tiketData as $item) {
                        echo '
                            <div class="glass-card ' . $item['color'] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                                <i class="' . $item['icon'] . ' text-4xl mb-2"></i>
                                <h2 class="text-lg font-semibold">' . $item['status'] . '</h2>
                                <span class="text-4xl font-bold mt-2">' . $item['total'] . '</span>
                            </div>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- Section Kehilangan & Penemuan -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Kehilangan dan Penemuan Barang</h2>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <?php
                if (isset($penemuanData) && is_array($penemuanData)) {
                    foreach ($penemuanData as $item) {
                        echo '
                    <div class="glass-card ' . $item[2] . ' shadow-lg hover:shadow-xl transition-all duration-300 p-6 rounded-xl text-white flex flex-col items-center justify-center h-44 transform hover:scale-105">
                        <i class="' . $item[3] . ' text-4xl mb-2"></i>
                        <h2 class="text-lg font-semibold">' . $item[0] . '</h2>
                        <span class="text-4xl font-bold mt-2">' . $item[1] . '</span>
                    </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <br><br>
</body>

</html>