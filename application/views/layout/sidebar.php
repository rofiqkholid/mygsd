<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

<body class="bg-gray-200">
    <div id="sidebar" class="sidebar fixed left-0 top-0 h-full bg-white shadow-md dark:bg-gray-900 p-4 closed z-50">
        <div class="sidebar-logo flex items-center p-2 m-4">
            <img src="<?= base_url('public/assets/img/logo_college.png') ?>" alt="Logo" class="h-8 w-7">
            <span class="ml-4">MyGSD Service</span>
        </div>
        <div class="menu-dashboard">
            <ul class="mt-10">
                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4 cursor-pointer">
                    <i class="bi bi-house-fill"></i>
                    <span>Dashboard</span>
                </li>

                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4 cursor-pointer" onclick="toggleDropdown('dropdown-tiket')">
                    <i class="bi bi-ticket-perforated-fill"></i>
                    <span>E-Tiketing</span>
                </li>
                <ul id="dropdown-tiket" class="dropdown hidden transition-all duration-300 ease-in-out transform -translate-y-2 opacity-0">
                    <li class="p-2 hover:text-red-800 cursor-pointer">Pesan Tiket</li>
                    <li class="p-2 hover:text-red-800 cursor-pointer">Riwayat Tiket</li>
                </ul>

                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4 cursor-pointer" onclick="toggleDropdown('dropdown-permit')">
                    <i class="bi bi-ui-checks"></i>
                    <span>E-Permit</span>
                </li>
                <ul id="dropdown-permit" class="dropdown hidden transition-all duration-300 ease-in-out transform -translate-y-2 opacity-0">
                    <li class="p-2 hover:text-red-800 cursor-pointer">Ajukan Permit</li>
                    <li class="p-2 hover:text-red-800 cursor-pointer">Riwayat Permit</li>
                </ul>

                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4 cursor-pointer" onclick="toggleDropdown('dropdown-lost')">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Lost and Found</span>
                </li>
                <ul id="dropdown-lost" class="dropdown hidden transition-all duration-300 ease-in-out transform -translate-y-2 opacity-0">
                    <div class="ml-10 flex">
                        <i class="bi bi-dash"></i>
                        <li class="p-2 hover:text-red-800 cursor-pointer">Laporkan Barang Hilang</li>
                    </div>
                    <li class="p-2 hover:text-red-800 cursor-pointer">Cek Barang Ditemukan</li>
                </ul>

                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4">
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </li>

                <a href="./">
                    <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4">
                        <i class="bi bi-door-open-fill"></i>
                        <span>Logout</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>

    <div id="content" class="content">
        <?php if (isset($content)) echo $content; ?>
    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);

            if (dropdown.classList.contains("hidden")) {
                dropdown.classList.remove("hidden");
                setTimeout(() => {
                    dropdown.classList.remove("opacity-0", "-translate-y-2");
                }, 10);
            } else {
                dropdown.classList.add("opacity-0", "-translate-y-2");
                setTimeout(() => {
                    dropdown.classList.add("hidden");
                }, 200);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");

            function updateContentMargin() {
                if (window.innerWidth > 768) {
                    content.style.marginLeft = sidebar.classList.contains("closed") ? "0" : "13rem";
                } else {
                    content.style.marginLeft = "0";
                }
            }

            sidebar.addEventListener("mouseenter", () => {
                sidebar.classList.remove("closed");
                updateContentMargin();
            });

            sidebar.addEventListener("mouseleave", () => {
                sidebar.classList.add("closed");
                updateContentMargin();
            });

            window.addEventListener("resize", updateContentMargin);
            updateContentMargin();
        });
    </script>
</body>