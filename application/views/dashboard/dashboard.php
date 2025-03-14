<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body class="bg-gray-100 flex">
    <?php $this->load->view('layout/sidebar'); ?>
    <div id="content" class="content w-full">
        <h1 class="text-2xl font-bold">Dashboard Monitoring</h1>

        <div class="admin-action grid grid-cols-6 gap-5 mt-5">
            <a href="">
                <div class="lost-found bg-blue-700 text-white p-2 rounded text-sm text-center">
                    <span>Lost and Found</span>
                </div>
            </a>
            <a href="">
                <div class="e-tiketing bg-blue-700 text-white p-2 rounded text-sm text-center">
                    <span>Request E-Tiketing</span>
                </div>
            </a>
            <a href="">
                <div class="e-permit bg-blue-700 text-white p-2 rounded text-sm text-center">
                    <span>Request E-Permit</span>
                </div>
            </a>
        </div>
        <div class="data-monitoring gap-10 mt-10 grid grid-cols-3">
            <div class="kehilangan bg-yellow-400 p-4 rounded font-bold text-center">
                <h2 class="text-2xl mb-5">Kehilangan Barang</h2>
                <span class="text-lg">0</span>
            </div>
            <div class="penemuan bg-green-400 p-4 rounded font-bold text-center">
                <h2 class="text-2xl mb-5">Penemuan Barang</h2>
                <span class="text-lg">0</span>
            </div>
        </div>

    </div>
</body>