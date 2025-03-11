<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="assets/css/app.css">


<head>
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
            width: 15rem;
            overflow: hidden;
        }

        .sidebar.closed {
            transform: translateX(-70%);
            width: 13rem;
        }

        .content {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 3rem;
            padding: 1rem;
        }

        .sidebar.closed+.content {
            margin-left: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease-in-out;
        }

        .nav-item i {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 0.5rem;
            min-width: 1.5rem;
            font-size: 1.5rem;
            text-align: center;
            font-style: normal;
        }

        .nav-item span {
            transition: opacity 0.3s ease-in-out, margin-left 0.3s ease-in-out;
            opacity: 1;
            font-size: 1rem;
            margin-left: 1.3rem;
            white-space: nowrap;
        }

        .sidebar.closed .nav-item span {
            opacity: 0;
            margin-left: 100px;
        }

        .sidebar.closed .nav-item i {
            margin-left: 7.7rem;
            font-size: 1.5rem;
            font-style: normal;
        }

        .sidebar-logo {
            transition: opacity 0.3s ease-in-out, margin-left 0.3s ease-in-out;
            opacity: 1;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .sidebar.closed .sidebar-logo {
            opacity: 0;
        }

        .sidebar.closed .icon-only {
            display: block;
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
    <div id="sidebar" class="sidebar fixed left-0 top-0 h-full bg-white shadow-md dark:bg-gray-900 p-4 closed z-50">
        <div class="sidebar-logo">MyGSD Service</div>
        <ul class="mt-10">
            <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4">
                <i class="bi bi-house-fill"></i>
                <span>Dashboard</span>
            </li>
            <li class="nav-item hover:bg-red-800 hover:text-white p-2 m-4">
                <i class="bi bi-person-fill"></i>
                <span>Profile</span>
            </li>
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

    <div id="content" class="content">
        <?php if (isset($content)) echo $content; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");

            function updateContentMargin() {
                if (window.innerWidth > 768) {
                    content.style.marginLeft = sidebar.classList.contains("closed") ? "0" : "12rem";
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