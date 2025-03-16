<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-gray-100 flex">
    <?php $this->load->view('layout/sidebar'); ?>
    <div id="content" class="content w-full p-6">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">E-Permit Monitoring</h1>

        <div class="glass-card shadow-lg p-6">
            <h2 class="text-xl mb-4 text-gray-800">E-Permit Data Per Tahun</h2>
            <div id="permitChart"></div>
        </div>
    </div>

    <script>
        var options = {
            series: [{
                name: "Permit",
                data: [2, 7, 15, 20, 18, 25, 30, 28, 24, 22, 20, 35]
            }],
            chart: {
                height: 350,
                type: 'area',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '14px',
                    colors: ['#333']
                }
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            markers: {
                size: 6,
                hover: {
                    size: 8
                }
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: true
                },
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            },
            colors: ['#ff9800'],
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right'
            }
        };

        var chart = new ApexCharts(document.querySelector("#permitChart"), options);
        chart.render();
        
    </script>
</body>

</html>