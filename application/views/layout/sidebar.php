<script src="https://cdn.tailwindcss.com"></script>
<head>
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
            width: 15rem;
        }

        .sidebar.closed {
            transform: translateX(-70%);
        }

        .content {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 5rem;
            padding: 1rem;
        }

        .sidebar.closed+.content {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                width: 250px;
                height: 100vh;
                z-index: 50;
                transform: translateX(-100%);
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-200">
    <button id="toggleSidebar" class="fixed top-4 text-2xl p-4 left-3 text-gray-500 hover:text-red-500 z-50">
        ☰
    </button>

    <div id="sidebar" class="sidebar fixed left-0 top-0 h-full w-64 bg-white shadow-md dark:bg-gray-900 p-4 closed">
        <button id="closeSidebar" class="absolute top-4 p-4 right-4 text-gray-500 hover:text-red-500">
            ✖
        </button>
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">MyGSD Service</h2>
        <ul class="mt-5">
            <li class="nav-item mb-2">
                <a href="<?= base_url('dashboard'); ?>" class="flex items-center p-3 rounded-md hover:bg-red-800 hover:text-white">
                    <span>🏠 Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="<?= base_url('profile'); ?>" class="flex items-center p-3 rounded-md hover:bg-red-800 hover:text-white">
                    <span>👤 Profile</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="<?= base_url('settings'); ?>" class="flex items-center p-3 rounded-md hover:bg-red-800 hover:text-white">
                    <span>⚙ Settings</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="<?= base_url('./'); ?>" class="flex items-center p-3 rounded-md hover:bg-red-800 hover:text-white">
                    <span>🚪 Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div id="content" class="content">
        <?php if (isset($content)) echo $content; ?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const toggleBtn = document.getElementById("toggleSidebar");
            const closeBtn = document.getElementById("closeSidebar");
            const content = document.getElementById("content");

            function updateContentMargin() {
                if (window.innerWidth > 768) {
                    content.style.marginLeft = sidebar.classList.contains("closed") ? "0" : "10rem";
                } else {
                    content.style.marginLeft = "0";
                }
            }

            toggleBtn.addEventListener("click", () => {
                sidebar.classList.toggle("closed");

                if (sidebar.classList.contains("closed")) {
                    toggleBtn.style.display = "block"; 
                    closeBtn.style.display = "none"; 
                } else {
                    toggleBtn.style.display = "none"; 
                    closeBtn.style.display = "block"; 
                }

                updateContentMargin();
            });

            closeBtn.addEventListener("click", () => {
                sidebar.classList.add("closed");
                toggleBtn.style.display = "block"; // Tampilkan tombol ☰ saat sidebar tertutup
                closeBtn.style.display = "none"; // Sembunyikan tombol ✖
                updateContentMargin();
            });

            // Sembunyikan tombol close saat sidebar dalam keadaan tertutup awalnya
            if (sidebar.classList.contains("closed")) {
                closeBtn.style.display = "none";
            }

            window.addEventListener("resize", updateContentMargin);
            updateContentMargin();
        });
    </script>
</body>

