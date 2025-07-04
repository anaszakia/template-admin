<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalyst - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-sm w-full max-w-sm">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-black rounded-full flex items-center justify-center">
                    <div class="w-3 h-3 bg-white rounded-full"></div>
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Logo</h1>
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-900 text-center mb-8">Selamat Datang</h2>
        <p class=" text-gray-900 text-center mb-8">Silahkan masukkan email dan password anda untuk masuk !</p>

        <!-- Login Form -->
        <form class="space-y-6">
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="Masukkan E-mail yang terdaftar"
                >
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        class="w-full px-3 py-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        placeholder="Masukkan Password"
                    >
                    <button 
                        type="button" 
                        id="togglePassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                    >
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        id="remember-me" 
                        name="remember-me" 
                        type="checkbox" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="remember-me" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                </div>
                <div class="text-sm">
                    <a href="/forgot-password" class="text-blue-600 hover:text-blue-500">Lupa password?</a>
                </div>
            </div>

            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out"
            >
                Masuk
            </button>

            <!-- Sign Up Link -->
            <div class="text-sm text-center text-gray-600 mt-6">
                Belum punya akun? <a href="/register" class="text-blue-600 hover:text-blue-500">Daftar</a>
            </div>
        </form>
    </div>

    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle the eye icon
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }
            
            // Here you would typically send the data to your server
            console.log('Login attempt:', { email, password });
            alert('Login functionality would be implemented here');
        });
    </script>
</body>
</html>