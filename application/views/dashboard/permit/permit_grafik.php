<?php

if (!$this->session->userdata('role') || !in_array($this->session->userdata('role'), ['staff',])) {
    redirect('auth');
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <title>Monitoring Grafik Permit</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="bg-gray-100 flex">
    <?php $this->load->view('layout/sidebar'); ?>

    <div id="content" class="content w-full p-6 ml-[5rem] mr-[2rem]">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">📊 E-Permit Monitoring</h1>

        <!-- Chart utama -->
        <div class="shadow-xl p-6 bg-white rounded-2xl grid grid-cols-1 md:grid-cols-1">
            <h2 class="text-lg font-bold mb-4 text-gray-700">📅 E-Permit Data Per Tahun</h2>
            <div id="permitChart"></div>
        </div>

        <!-- 2 Chart kecil -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="shadow-lg p-6 bg-white rounded-2xl">
                <h2 class="text-lg font-bold mb-4 text-gray-700">📊 Data Per Bulan</h2>
                <div id="permitChart2"></div>
            </div>
            <div class="shadow-lg p-6 bg-white rounded-2xl">
                <h2 class="text-lg font-bold mb-4 text-gray-700">📊 Tren Per Tahun</h2>
                <div id="permitChart3"></div>
            </div>
        </div>
        <br><br>
    </div>

    <script>
        // Opsi Chart
        var options = {
            series: [{
                    name: "Izin Masuk",
                    data: [2, 7, 15, 20, 18, 25, 30, 28, 24, 22, 20, 35]
                },
                {
                    name: "Terima",
                    data: [0, 0, 4, 6, 1, 9, 0, 0, 0, 3, 5, 1]
                },
                {
                    name: "Tolak",
                    data: [0, 0, 0, 0, 2, 0, 0, 0, 0, 1, 5, 0]
                },
                {
                    name: "Pending",
                    data: [0, 0, 0, 1, 0, 0, 4, 0, 0, 3, 1, 0]
                }
            ],
            chart: {
                type: 'area',
                height: 350,
                background: "#ffffff",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 5,
                hover: {
                    size: 7
                }
            },
            tooltip: {
                theme: 'dark'
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                labels: {
                    style: {
                        colors: '#666'
                    }
                }
            },
            colors: ['#007bff', '#28a745', '#dc3545', '#ffc107'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 0.4,
                    opacityFrom: 0.6,
                    opacityTo: 0.5,
                    stops: [0, 90, 100]
                }
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '12px',
                labels: {
                    colors: '#333'
                },
                itemMargin: {
                    horizontal: 30,
                    vertical: 10
                }
            }

        };

        var chart = new ApexCharts(document.querySelector("#permitChart"), options);
        chart.render();
        var chart = new ApexCharts(document.querySelector("#permitChart2"), options);
        chart.render();
        var chart = new ApexCharts(document.querySelector("#permitChart3"), options);
        chart.render();
    </script>
</body>

</html>