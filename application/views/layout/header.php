<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['SCRIPT_NAME']);
if ($currentPage == '') {
    $currentPage = 'index.php';
}

$id_user = isset($_SESSION['id_user']);

function getLinkClasses($pageName, $currentPage)
{
    $baseClasses = 'px-3 py-2 rounded-md text-sm font-medium transition duration-200 ease-in-out flex items-center group';
    $activeClasses = 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-md hover:from-blue-700 hover:to-blue-800';
    $inactiveClasses = 'text-gray-700 hover:text-blue-600 hover:bg-blue-50';
    
    $isActive = false;
    if ($pageName == $currentPage) {
        $isActive = true;
    } else if ($pageName == 'status_laporan' && strpos($_SERVER['REQUEST_URI'], 'status_laporan') !== false) {
        $isActive = true;
    } else if ($pageName == 'main' && strpos($_SERVER['REQUEST_URI'], 'main') !== false) {
        $isActive = true;
    }
    
    return $baseClasses . ' ' . ($isActive ? $activeClasses : $inactiveClasses);
}

function getMobileLinkClasses($pageName, $currentPage)
{
    $baseClasses = 'block px-4 py-3 rounded-md text-base font-medium transition duration-200 ease-in-out flex items-center';
    $activeClasses = 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-sm';
    $inactiveClasses = 'text-gray-700 hover:text-blue-600 hover:bg-blue-50';
    
    $isActive = false;
    if ($pageName == $currentPage) {
        $isActive = true;
    } else if ($pageName == 'status_laporan' && strpos($_SERVER['REQUEST_URI'], 'status_laporan') !== false) {
        $isActive = true;
    
    } else if ($pageName == 'main' && strpos($_SERVER['REQUEST_URI'], 'main') !== false) {
        $isActive = true;
    }
    
    return $baseClasses . ' ' . ($isActive ? $activeClasses : $inactiveClasses);
}
?>  
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGSD Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .logo-text {
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-item-icon {
            transition: transform 0.2s ease;
        }

        .group:hover .nav-item-icon {
            transform: translateY(-2px);
        }

        .header-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 10px rgba(37, 99, 235, 0.35);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(to right, #dc2626, #b91c1c);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(220, 38, 38, 0.25);
        }

        .btn-danger:hover {
            box-shadow: 0 6px 10px rgba(220, 38, 38, 0.35);
            transform: translateY(-1px);
        }

        .mobile-menu-transition {
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }

        .mobile-menu-active {
            max-height: 400px;
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <header class="bg-white header-shadow sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <div class="flex-shrink-0 animate__animated animate__fadeIn">
                    <a href="<?= base_url('/main') ?>" title="Kembali ke Beranda" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-blue-600 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                        </svg>
                        <span class="text-2xl font-bold logo-text transition duration-300 ease-in-out hover:scale-105">MyGSD Service</span>
                    </a>
                </div>

                <div class="hidden md:flex md:items-center md:space-x-1 lg:space-x-2">
                    <a href="<?= base_url('/main') ?>" class="<?= getLinkClasses('main', $currentPage) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5 nav-item-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Beranda
                    </a>
                    <a href="<?= base_url('status_laporan/' . $id_user) ?>" class="<?= getLinkClasses('status_laporan', $currentPage) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5 nav-item-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        Laporan Saya
                    </a>
                    <a href="/layanan.php" class="<?= getLinkClasses('layanan.php', $currentPage) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5 nav-item-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.05a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.05m16.5 0a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25m16.5 0v-4.05a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25v4.05m0 0H21" />
                        </svg>
                        Layanan
                    </a>
                    <a href="/kontak.php" class="<?= getLinkClasses('kontak.php', $currentPage) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5 nav-item-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        Kontak
                    </a>
                </div>

                <div class="hidden md:block">
                    <?php if ($id_user): ?>
                        <a href="auth/logout" class="ml-4 inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white btn-danger focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </a>
                    <?php else: ?>
                        <div class="flex space-x-3">
                            <a href="/login.php" class="inline-flex items-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-6 0l2.25-2.25M12 12l2.25 2.25M12 12l-2.25 2.25M12 12l2.25-2.25" />
                                </svg>
                                Login
                            </a>
                            <a href="/register.php" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-200 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3.75 15.75v-1.5a3.375 3.375 0 0 1 3.375-3.375h6.75a3.375 3.375 0 0 1 3.375 3.375v1.5M4.875 15.75h14.25" />
                                </svg>
                                Daftar
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition duration-200 ease-in-out" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <svg id="icon-hamburger" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg id="icon-close" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </nav>

        <div class="md:hidden mobile-menu-transition" id="mobile-menu">
            <div class="px-4 pt-3 pb-4 space-y-2 sm:px-5">
                <a href="/" class="<?= getMobileLinkClasses('index.php', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Beranda
                </a>
                <a href="/tentang.php" class="<?= getMobileLinkClasses('tentang.php', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    Tentang Kami
                </a>
                <a href="/layanan.php" class="<?= getMobileLinkClasses('layanan.php', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.05a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.05m16.5 0a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25m16.5 0v-4.05a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25v4.05m0 0H21" />
                    </svg>
                    Layanan
                </a>
                <a href="/kontak.php" class="<?= getMobileLinkClasses('kontak.php', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    Kontak
                </a>
            </div>
            <div class="pt-4 pb-4 border-t border-gray-200">
                <?php if ($id_user): ?>
                    <div class="px-5">
                        <a href="base_url('auth/logout')" class="flex justify-center items-center w-full px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white btn-danger text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </a>
                    </div>
                <?php else: ?>
                    <div class="px-5 space-y-3">
                        <a href="/login.php" class="flex justify-center items-center w-full px-4 py-3 border border-blue-300 rounded-md text-base font-medium text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-6 0l2.25-2.25M12 12l2.25 2.25M12 12l-2.25 2.25M12 12l2.25-2.25" />
                            </svg>
                            Login
                        </a>
                        <a href="/register.php" class="flex justify-center items-center w-full px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white btn-primary text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3.75 15.75v-1.5a3.375 3.375 0 0 1 3.375-3.375h6.75a3.375 3.375 0 0 1 3.375 3.375v1.5M4.875 15.75h14.25" />
                            </svg>
                            Daftar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');

        btn.addEventListener('click', () => {
            const isExpanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', !isExpanded);
            menu.classList.toggle('mobile-menu-active');
            iconHamburger.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>

</body>

</html>