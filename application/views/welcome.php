<title>Welcome to MyGSD Service</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    body {
        height: 100vh;
        width: 100%;
        background: url('./assets/img/bg-horizon.jpg') center/cover no-repeat;
        position: relative;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .container {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        text-align: center;
    }

    .welcome-message {
        color: #fff;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-get-started {
        display: inline-block;
        background-color: #b91c1c;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-get-started:hover {
        background-color: #991b1b;
    }

    header nav a {
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    header nav a:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>
<header class="fixed top-0 left-0 w-full bg-red-800 text-white shadow-lg z-50">
    <div class="container mx-auto flex items-center justify-between p-3">
        <div class="flex items-center space-x-4">
            <img src="<?= base_url('assets/img/bg-horizon.jpg'); ?>" alt="Logo" class="h-8 w-8 rounded-full object-cover">
            <span class="text-lg font-bold">MyGSD Service</span>
        </div>
        <nav class="flex space-x-4 ml-auto">
            <a href="<?= site_url('home'); ?>" class="hover:text-gray-300">Home</a>
            <a href="<?= site_url('about'); ?>" class="hover:text-gray-300">About</a>
            <a href="<?= site_url('services'); ?>" class="hover:text-gray-300">Services</a>
            <a href="<?= site_url('contact'); ?>" class="hover:text-gray-300">Contact</a>
        </nav>
    </div>
</header>

<body>
    <div class="container">
        <div>
            <h2 class="welcome-message">Welcome to MyGSD Web Service and Report</h2>
            <a href="<?= site_url('main'); ?>" class="btn-get-started">Get Started</a>
        </div>
    </div>

    <?php $this->load->view('layout/service'); ?>
    <?php $this->load->view('layout/footer'); ?>
</body>

</html>