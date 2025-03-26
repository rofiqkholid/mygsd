<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-200">
    <div id="sidebar" class="sidebar fixed left-0 top-0 h-full bg-white shadow-md dark:bg-gray-900 p-4 closed z-50">
        <div class="sidebar-logo flex items-center p-2 m-2">
            <img src="<?= base_url('public/assets/img/logo_college.png') ?>" alt="Logo" class="h-8 w-7">
            <span>MyGSD Service</span>
            <button id="toggleGeser">
                <i class="bi bi-chevron-double-right text-xl flex ml-4 rounded p-1 text-red-800 mt-1"></i>
            </button>
        </div>
        <div class="menu-dashboard">
            <ul class="mt-10">
                <a href="<?= base_url('/dashboard') ?>">
                    <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-2 cursor-pointer">
                        <i class="bi bi-house-fill"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-2 cursor-pointer" onclick="toggleDropdown('dropdown-tiket')">
                    <i class="bi bi-ticket-perforated-fill"></i>
                    <span>E-Tiketing</span>
                </li>
                <ul id="dropdown-tiket" class="dropdown overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
                    <div class="pb-7">
                        <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                            <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                            <span class="subtitle ml-3 text-[13px]">Monitoring E-Tiket</span>
                        </li>
                        <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                            <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                            <span class="subtitle ml-3 text-[13px]">Approval</span>
                        </li>
                    </div>
                </ul>
                <!-- E-Permit -->
                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-2 cursor-pointer" onclick="toggleDropdown('dropdown-permit')">
                    <i class="bi bi-ui-checks"></i>
                    <span>E-Permit</span>
                </li>
                <ul id="dropdown-permit" class="dropdown overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
                    <div class="pb-7">
                        <a href="<?= base_url('epermit/monitoring_permit') ?>">
                            <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                                <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                                <span class="subtitle ml-3 text-[13px]">Monitoring</span>
                            </li>
                        </a>
                        <a href="<?= base_url('epermit/permit_grafik') ?>">
                            <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                                <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                                <span class="subtitle ml-3 text-[13px]">Grafik </span>
                            </li>
                        </a>
                    </div>
                </ul>
            </ul>

            <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-2 cursor-pointer" onclick="toggleDropdown('dropdown-lost')">
                <i class="bi bi-box-seam-fill"></i>
                <span>Lost and Found</span>
            </li>
            <ul id="dropdown-lost" class="dropdown overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
                <div class="pb-7">
                    <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                        <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                        <span class="subtitle ml-3 text-[13px]">Monitoring</span>
                    </li>
                    <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                        <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                        <span class="subtitle ml-3 text-[13px]">Grafik</span>
                    </li>
                    <li class="p-2 flex items-center group hover:text-red-800 transition-all duration-300 cursor-pointer ml-4">
                        <div class="dash w-3 h-0.5 bg-gray-400 transition-all duration-300 group-hover:w-6 group-hover:bg-red-800"></div>
                        <span class="subtitle ml-3 text-[13px]">Detail Kehilangan</span>
                    </li>
                </div>
            </ul>
            </ul>

            <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-2">
                <i class="bi bi-gear-fill"></i>
                <span>Settings</span>
            </li>

            <a href="<?= site_url('auth/logout'); ?>">
                <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-2">
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
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("keydown", function(event) {
                if ((event.ctrlKey && event.key === "c") || (event.metaKey && event.key === "c")) {
                    event.preventDefault();
                }
            });
            document.addEventListener("selectstart", function(event) {
                event.preventDefault();
            });
        });

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const allDropdowns = document.querySelectorAll('.dropdown');

            allDropdowns.forEach(menu => {
                if (menu !== dropdown) {
                    menu.style.maxHeight = "0px";
                    menu.style.opacity = "0";
                }
            });

            if (dropdown.style.maxHeight === "0px" || !dropdown.style.maxHeight) {
                dropdown.style.maxHeight = dropdown.scrollHeight + "px";
                dropdown.style.opacity = "1";
            } else {
                dropdown.style.maxHeight = "0px";
                dropdown.style.opacity = "0";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const dropdowns = document.querySelectorAll('.dropdown');
            const toggleButton = document.getElementById("toggleGeser");

            let isShifted = false;
            toggleButton.addEventListener("click", function() {
                isShifted = !isShifted;

                if (isShifted) {
                    content.style.marginLeft = "10rem";
                } else {
                    content.style.marginLeft = "0rem";
                }
            });

            function checkSidebar() {
                if (sidebar.classList.contains("closed")) {
                    content.style.marginLeft = "";
                    isShifted = false;
                }
            }

            sidebar.addEventListener("mouseenter", () => {
                sidebar.classList.remove("closed");
            });

            sidebar.addEventListener("mouseleave", () => {
                sidebar.classList.add("closed");
                dropdowns.forEach(dropdown => {
                    dropdown.style.maxHeight = "0px";
                    dropdown.style.opacity = "0";
                });
            });

            const observer = new MutationObserver(checkSidebar);
            observer.observe(sidebar, {
                attributes: true
            });

            
        });
    </script>
</body>