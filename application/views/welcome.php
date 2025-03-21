<title>Welcome to MyGSD Service</title>
<?php $this->load->view('layout/welcome-head'); ?> <br>
<style>
    body {
        height: 100vh;
        width: 100%;
        background-size: cover;
        background-image: url('./assets/img/bg-horizon.jpg');
        background-position: center;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 105vh;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .container::before {
        z-index: 2;
    }
</style>

<body>
    <div class="container">
        <div class="introduce flex items-center justify-center h-screen text-center relative z-10">
            <div class="flex-block">
                <h2 class="font-bold text-5xl mb-20 text-white">Welcome to MyGSD Web Service and Report</h2>
                <a href="<?= site_url('dashboard/main'); ?>">
                    <span class="bg-red-800 p-3 text-white rounded-lg cursor-pointer">Get Started</span>
                </a>
            </div>
        </div>1
    </div>

    <?php $this->load->view('layout/service'); ?>
    <?php $this->load->view('layout/about'); ?>
    <?php $this->load->view('layout/footer'); ?>
</body>

</html>