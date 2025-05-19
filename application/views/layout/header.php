<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['SCRIPT_NAME']);
if ($currentPage == '') {
    $currentPage = 'index.php';
}

$id_user = isset($_SESSION['id_user']);
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : null;

function getLinkClasses($pageName, $currentPage)
{
    $baseClasses = 'group relative px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 ease-in-out flex items-center';
    $activeClasses = 'text-white bg-gradient-to-r from-blue-600 to-indigo-600 shadow-md hover:shadow-lg';
    $inactiveClasses = 'text-gray-700 hover:text-blue-600 hover:bg-blue-50';

    $isActive = false;
    if ($pageName == $currentPage) {
        $isActive = true;
    } else if ($pageName == 'status_laporan' && strpos($_SERVER['REQUEST_URI'], 'status_laporan') !== false) {
        $isActive = true;
    } else if ($pageName == 'main' && strpos($_SERVER['REQUEST_URI'], 'main') !== false) {
        $isActive = true;
    }
    else if ($pageName == 'status_permit' && strpos($_SERVER['REQUEST_URI'], 'status_permit') !== false) {
        $isActive = true;
    }

    return $baseClasses . ' ' . ($isActive ? $activeClasses : $inactiveClasses);
}

function getMobileLinkClasses($pageName, $currentPage)
{
    $baseClasses = 'group w-full flex items-center px-4 py-3 rounded-lg text-base font-medium transition-all duration-300 ease-in-out';
    $activeClasses = 'text-white bg-gradient-to-r from-blue-600 to-indigo-600 shadow-sm';
    $inactiveClasses = 'text-gray-700 hover:text-blue-600 hover:bg-blue-50';

    $isActive = false;
    if ($pageName == $currentPage) {
        $isActive = true;
    } else if ($pageName == 'status_laporan' && strpos($_SERVER['REQUEST_URI'], 'status_laporan') !== false) {
        $isActive = true;
    } else if ($pageName == 'main' && strpos($_SERVER['REQUEST_URI'], 'main') !== false) {
        $isActive = true;
    }
    else if ($pageName == 'status_permit' && strpos($_SERVER['REQUEST_URI'], 'status_permit') !== false) {
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
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        },
                    },
                    boxShadow: {
                        'nav': '0 4px 20px rgba(0, 0, 0, 0.05)',
                        'nav-dark': '0 4px 20px rgba(0, 0, 0, 0.1)',
                        'button': '0 4px 12px rgba(79, 70, 229, 0.25)',
                        'button-hover': '0 6px 16px rgba(79, 70, 229, 0.35)',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .logo-text {
            background: linear-gradient(135deg, #4f46e5, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-icon {
            transition: all 0.3s ease;
        }

        .group:hover .nav-icon {
            transform: translateY(-2px);
            color: #4f46e5;
        }

        .active-link-indicator {
            height: 3px;
            width: 0;
            background: #4f46e5;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .group:hover .active-link-indicator {
            width: 60%;
        }

        .nav-active .active-link-indicator {
            width: 60%;
        }

        .header-glass {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .user-badge {
            border: 2px solid rgba(99, 102, 241, 0.3);
            box-shadow: 0 2px 6px rgba(99, 102, 241, 0.15);
        }

        .btn-gradient {
            background-image: linear-gradient(135deg, #4f46e5, #2563eb);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .btn-gradient:hover {
            background-image: linear-gradient(135deg, #4338ca, #1d4ed8);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
            transform: translateY(-1px);
        }

        .btn-danger {
            background-image: linear-gradient(135deg, #ef4444, #dc2626);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            background-image: linear-gradient(135deg, #dc2626, #b91c1c);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
            transform: translateY(-1px);
        }

        .mobile-menu-transition {
            transition: max-height 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                opacity 0.3s ease-in-out,
                transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            max-height: 0;
            opacity: 0;
            transform: translateY(-10px);
            overflow: hidden;
        }

        .mobile-menu-active {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <header class="bg-white/95 header-glass shadow-nav sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="relative flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 animate__animated animate__fadeIn">
                    <a href="<?= base_url('/main') ?>" title="Kembali ke Beranda" class="flex items-center group">
                        <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg mr-2.5 transition-transform duration-300 group-hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold logo-text transition-all duration-300 ease-in-out group-hover:scale-105">MyGSD Service</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:space-x-2">
                    <a href="<?= base_url('/main') ?>" class="<?= getLinkClasses('main', $currentPage) ?> <?= ($currentPage == 'main' || strpos($_SERVER['REQUEST_URI'], 'main') !== false) ? 'nav-active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 nav-icon transition-all duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Beranda
                        <span class="active-link-indicator"></span>
                    </a>
                    <a href="<?= base_url('status_laporan/' . $id_user) ?>" class="<?= getLinkClasses('status_laporan', $currentPage) ?> <?= (strpos($_SERVER['REQUEST_URI'], 'status_laporan') !== false) ? 'nav-active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 nav-icon transition-all duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        Laporan Saya
                        <span class="active-link-indicator"></span>
                    </a>
                    <a href="<?= base_url('status_permit/' . $id_user) ?>" class="<?= getLinkClasses('status_permit', $currentPage) ?> <?= (strpos($_SERVER['REQUEST_URI'], 'status_permit') !== false) ? 'nav-active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 nav-icon transition-all duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        Status Permit
                        <span class="active-link-indicator"></span>
                    </a>
                    <a href="/kontak.php" class="<?= getLinkClasses('kontak.php', $currentPage) ?> <?= ($currentPage == 'kontak.php') ? 'nav-active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 nav-icon transition-all duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        Kontak
                        <span class="active-link-indicator"></span>
                    </a>
                </div>

                <!-- User Section Desktop -->
                <div class="hidden md:flex md:items-center">
                    <?php if ($id_user): ?>
                        <div class="flex items-center space-x-4">
                            <div class="user-badge flex items-center px-4 py-1.5 rounded-full bg-indigo-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-600 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span class="text-indigo-700 font-medium"><?= $username ?></span>
                            </div>
                            <a href="<?= base_url('auth/logout') ?>" class="flex justify-center items-center px-4 py-2.5 rounded-lg shadow-md text-sm font-medium text-white btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                Logout
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-all duration-300 ease-in-out" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <svg id="icon-hamburger" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg id="icon-close" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Mobile menu panel -->
        <div class="md:hidden mobile-menu-transition bg-white/95 border-t border-gray-100" id="mobile-menu">
            <div class="container mx-auto px-4 pt-2 pb-4 space-y-2">
                <a href="<?= base_url('/main') ?>" class="<?= getMobileLinkClasses('main', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Beranda
                </a>
                <a href="<?= base_url('status_laporan/' . $id_user) ?>" class="<?= getMobileLinkClasses('status_laporan', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    Laporan Saya
                </a>
                <a href="<?= base_url('status_permit/' . $id_user) ?>" class="<?= getMobileLinkClasses('status_permit', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.05a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.05m16.5 0a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25m16.5 0v-4.05a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25v4.05m0 0H21" />
                    </svg>
                    Status Permit
                </a>
                <a href="/kontak.php" class="<?= getMobileLinkClasses('kontak.php', $currentPage) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    Kontak
                </a>
            </div>

            <!-- User section on mobile -->
            <?php if ($id_user): ?>
                <div class="container mx-auto px-4 pt-3 pb-4 border-t border-gray-100">
                    <div class="flex flex-col space-y-3">
                        <div class="user-badge self-start flex items-center px-4 py-2 rounded-full bg-indigo-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-600 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span class="text-indigo-700 font-medium"><?= $username ?></span>
                        </div>
                        <a href="<?= base_url('auth/logout') ?>" class="flex justify-center items-center w-full px-4 py-3 rounded-lg shadow-md text-base font-medium text-white btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <script>
        // Mobile menu toggle
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

        // Scroll effect for header
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('shadow-nav-dark');
                header.classList.remove('shadow-nav');
            } else {
                header.classList.add('shadow-nav');
                header.classList.remove('shadow-nav-dark');
            }
        });
    </script>
</body>

</html>