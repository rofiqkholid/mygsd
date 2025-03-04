
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="<?= base_url('./assets/css/output.css'); ?>" rel="stylesheet">
</head>

<body class="bg-gray-100 flex">
    <?php $this->load->view('layout/sidebar'); ?> 

    <div id="content" class="content">
        <h1 class="text-2xl font-bold">Selamat Datang di Dashboard</h1>
        <p>Ini adalah halaman utama.</p>
    </div>
</body>