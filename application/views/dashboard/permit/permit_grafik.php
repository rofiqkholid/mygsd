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

        <div class="shadow-xl p-6 bg-white rounded-2xl grid grid-cols-1 md:grid-cols-1">
            <h2 class="text-lg font-bold mb-4 text-gray-700">📅 E-Permit Data Per Tahun</h2>
            <div id="permitChart"></div>
        </div><br>
        <div class="shadow-lg p-6 bg-white rounded-2xl">
            <h2 class="text-lg font-bold mb-4 text-gray-700">📊 Data Tiketing</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Years</th>
                        <th class="border p-2">Months</th>
                        <th class="border p-2">Days</th>
                        <th class="border p-2">UserID</th>
                        <th class="border p-2">SubjectService</th>
                        <th class="border p-2">Desc</th>
                        <th class="border p-2">Location</th>
                        <th class="border p-2">Image</th>
                        <th class="border p-2">IDTiketing</th>
                        <th class="border p-2">Status Tiketing</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Dummy -->
                    <tr>
                        <td class="border p-2">2024</td>
                        <td class="border p-2">3</td>
                        <td class="border p-2">26</td>
                        <td class="border p-2">U001</td>
                        <td class="border p-2">Layanan IT</td>
                        <td class="border p-2">Komputer error</td>
                        <td class="border p-2">Lab 101</td>
                        <td class="border p-2">img1.png</td>
                        <td class="border p-2">T001</td>
                        <td class="border p-2">
                            <select class="border rounded px-2 py-1">
                                <option>Pending</option>
                                <option>Disetujui</option>
                                <option>Ditolak</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="border p-2">2024</td>
                        <td class="border p-2">3</td>
                        <td class="border p-2">27</td>
                        <td class="border p-2">U002</td>
                        <td class="border p-2">Fasilitas</td>
                        <td class="border p-2">AC rusak</td>
                        <td class="border p-2">Ruang 202</td>
                        <td class="border p-2">img2.png</td>
                        <td class="border p-2">T002</td>
                        <td class="border p-2">
                            <select class="border rounded px-2 py-1">
                                <option>Pending</option>
                                <option>Disetujui</option>
                                <option>Ditolak</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="shadow-lg p-6 bg-white rounded-2xl">
                <h2 class="text-lg font-bold mb-4 text-gray-700">📊 Data Per Bulan</h2>
                <div id="permitChart2"></div>
            </div>
        </div>
        <br><br>
    </div>

    <script>
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

        var options2 = {
            series: [{
                    name: "Izin Masuk",
                    data: [3, 3, 4, 5, 4, 5, 4, 3, 3, 4, 5, 5, 4, 3, 4, 4, 5, 4, 3, 4, 5, 4, 4, 3, 5, 4, 4, 3, 4, 4, 3]
                },
                {
                    name: "Terima",
                    data: [2, 2, 3, 2, 3, 2, 3, 2, 2, 3, 2, 3, 2, 2, 3, 2, 3, 2, 2, 3, 2, 3, 2, 3, 2, 2, 3, 2, 3, 2, 2]
                },
                {
                    name: "Tolak",
                    data: [1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 1, 1, 2, 1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 2, 1, 1, 2, 1, 1, 1]
                },
                {
                    name: "Pending",
                    data: [2, 2, 3, 3, 3, 3, 2, 3, 2, 3, 3, 3, 2, 3, 3, 2, 3, 3, 2, 3, 3, 2, 3, 3, 2, 3, 3, 2, 3, 3, 2]
                }
            ],
            chart: {
                type: 'line',
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
                categories: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
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
        var chart = new ApexCharts(document.querySelector("#permitChart2"), options2);
        chart.render();
        var chart = new ApexCharts(document.querySelector("#permitChart3"), options);
        chart.render();
    </script>
</body>

</html>