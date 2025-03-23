<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyGSD Service</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen" style="background-image: url('<?php echo base_url('assets/img/bg-horizon.jpg'); ?>'); background-size: cover; background-position: center;">
    <div class="flex flex-col justify-center items-center min-h-screen">
        <!-- Login Form -->
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Welcome Back</h2>
            <p class="text-center text-gray-600 mb-4">Please login to your account</p>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md mb-4">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo site_url('auth/proses_login'); ?>" method="POST" class="space-y-6">
                <div>
                    <label for="no_identity" class="block text-sm font-medium text-gray-700">No Identity / NPM / NIK</label>
                    <input type="text" id="no_identity" name="no_identity" placeholder="Enter your NPM" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-50 0 focus:border-blue-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Login
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <a href="#" class="text-sm text-blue-500 hover:underline">Forgot your password?</a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-center text-gray-600 text-sm">
            &copy; <?php echo date('Y'); ?> MyGSD Service. All rights reserved.
        </footer>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            this.innerHTML = type === 'password' 
                ? `<i class="bi bi-eye"></i>`
                : `<i class="bi bi-eye-slash"></i>`;
        });
    </script>
</body>

</html>
