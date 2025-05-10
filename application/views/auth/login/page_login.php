<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        input::placeholder {
            color: #A0AEC0; 
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-gray-800 via-gray-900 to-black min-h-screen flex items-center justify-center p-6">

    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg shadow-2xl rounded-xl p-8 md:p-12 w-full max-w-md transform transition-all duration-500 hover:scale-105">
        
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-white tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-gray-300 mt-2 text-sm">Silakan masuk untuk melanjutkan.</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-500 bg-opacity-50 border border-red-700 text-red-100 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-semibold">Oops!</strong>
                <span class="block sm:inline"><?php echo $this->session->flashdata('error'); ?></span>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo site_url('auth/proses_login'); ?>" class="space-y-6">
            <div>
                <label for="identity" class="block text-sm font-medium text-gray-200 mb-1">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="identity" id="identity" placeholder="Masukkan username Anda"
                           class="appearance-none block w-full bg-gray-700 bg-opacity-50 text-white border border-gray-600 rounded-lg py-3 px-4 pl-10 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out placeholder-gray-500"
                           required>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-200 mb-1">Password</label>
                <div class="relative">
                     <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M2 6a8 8 0 1113.336 5.854l1.398 1.398A.75.75 0 0116.25 14H3.75a.75.75 0 01-.484-.148L1.868 12.46A8.003 8.003 0 012 6zm6.25-.75a.75.75 0 00-1.5 0v1.5h-1.5a.75.75 0 000 1.5h1.5v1.5a.75.75 0 001.5 0v-1.5h1.5a.75.75 0 000-1.5h-1.5V5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" placeholder="Masukkan password Anda"
                           class="appearance-none block w-full bg-gray-700 bg-opacity-50 text-white border border-gray-600 rounded-lg py-3 px-4 pl-10 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out placeholder-gray-500"
                           required>
                </div>
                <div class="text-right mt-2">
                    <a href="#" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition duration-300 ease-in-out">
                        Lupa password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                    Login
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-gray-400">
            Belum punya akun? 
            <a href="#" class="font-medium text-indigo-400 hover:text-indigo-300 transition duration-300 ease-in-out">
                Daftar di sini
            </a>
        </p>

    </div>
</body>
</html>