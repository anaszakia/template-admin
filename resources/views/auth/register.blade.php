<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalyst - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
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
        <h2 class="text-2xl font-semibold text-gray-900 text-center mb-8">Buat akun</h2>

        <!-- Registration Form -->
        <form class="space-y-6" id="registerForm">
            <!-- Full Name Input -->
            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="fullName" 
                    class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="Masukkan nama lengkap"
                >
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                <input 
                    type="email" 
                    id="email" 
                    class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="Masukkan e-mail anda"
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
                        placeholder="Buat password"
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

            <!-- Confirm Password Input -->
            <div>
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        class="w-full px-3 py-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        placeholder="Konfirmasi password"
                    >
                    <button 
                        type="button" 
                        id="toggleConfirmPassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                    >
                        <i class="fas fa-eye" id="eyeConfirmIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
                <input 
                    id="terms" 
                    name="terms" 
                    type="checkbox" 
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1"
                >
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
                </label>
            </div>

            <!-- Sign Up Button -->
            <button 
                type="submit" 
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out"
            >
                Buat Akun
            </button>

            <!-- Sign In Link -->
            <div class="text-sm text-center text-gray-600 mt-6">
                Sudah punya akun ? <a href="/login" class="text-blue-600 hover:text-blue-500">Masuk</a>
            </div>
        </form>
    </div>

    <script>
        // Password visibility toggle for password field
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });

        // Password visibility toggle for confirm password field
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const eyeConfirmIcon = document.getElementById('eyeConfirmIcon');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            
            if (type === 'password') {
                eyeConfirmIcon.classList.remove('fa-eye-slash');
                eyeConfirmIcon.classList.add('fa-eye');
            } else {
                eyeConfirmIcon.classList.remove('fa-eye');
                eyeConfirmIcon.classList.add('fa-eye-slash');
            }
        });

        // Form submission handler
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;
            
            // Validation
            if (!fullName || !email || !password || !confirmPassword) {
                alert('Please fill in all fields');
                return;
            }
            
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }
            
            if (password.length < 6) {
                alert('Password must be at least 6 characters long');
                return;
            }
            
            if (!terms) {
                alert('Please accept the Terms of Service and Privacy Policy');
                return;
            }
            
            // Here you would typically send the data to your server
            console.log('Registration attempt:', { fullName, email, password });
            alert('Registration successful! Please check your email for verification.');
        });
    </script>
</body>
</html>