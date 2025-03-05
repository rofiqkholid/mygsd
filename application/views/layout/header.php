<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGSD Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-red-800 w-full shadow-md py-4 fixed">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-white">MyGSD Service</a>
            
            <nav class="hidden md:flex space-x-6 mr-10">
                <a href="#" class="text-white hover:font-bold w-16 text-center">Home</a>
                <a href="#" class="text-white hover:font-bold w-16 text-center">Services</a>
                <a href="#" class="text-white hover:font-bold w-16 text-center">About</a>
                <a href="#" class="text-white hover:font-bold w-16 text-center">Contact</a>
            </nav>
            
            <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        
        <div class="hidden md:hidden bg-red-800 p-4" id="mobile-menu">
            <a href="#" class="block py-2 px-4 text-white hover:bg-red-900">Home</a>
            <a href="#" class="block py-2 px-4 text-white hover:bg-red-900">Services</a>
            <a href="#" class="block py-2 px-4 text-white hover:bg-red-900">About</a>
            <a href="#" class="block py-2 px-4 text-white hover:bg-red-900">Contact</a>
        </div>
    </header>
    
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
