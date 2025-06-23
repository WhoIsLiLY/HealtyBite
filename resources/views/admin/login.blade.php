<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-500 to-blue-600 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden animate__animated animate__fadeIn">
            <!-- Success Message -->
            @if (session('success'))
                <div class="px-6 pt-6">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <strong class="font-bold">Success! </strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <div class="px-8 py-10">
                <div class="text-center mb-8">
                    <svg class="mx-auto h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                    </svg>
                    <h2 class="mt-4 text-3xl font-extrabold text-gray-800">Admin Login</h2>
                    <p class="mt-2 text-gray-600">Enter your credentials to access the dashboard</p>
                </div>

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" autocomplete="email" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-gray-800 placeholder-gray-400 transition duration-200"
                                placeholder="admin@example.com">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" autocomplete="current-password" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-gray-800 placeholder-gray-400 transition duration-200"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="loginButton"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                            <span id="button-text">Sign in</span>
                            <svg id="button-spinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Links Section -->
                    <div class="flex flex-col space-y-3 text-center text-sm">
                        <a href="/" class="font-medium text-green-600 hover:text-green-500 transition">
                            ← Login as a Customer
                        </a>
                        <a href="{{ route('admin.register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                            Don't have an account? Register here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('form').on('submit', function (e) {
                e.preventDefault();

                var formArray = $(this).serializeArray();
                var formData = {};
                formArray.forEach(function (item) {
                    formData[item.name] = item.value;
                });

                formData.type = "admin";

                var $signInBtn = $('#loginButton');
                var $buttonText = $('#button-text');
                var $buttonSpinner = $('#button-spinner');
                
                // Show loading state
                $buttonText.text("Signing in...");
                $buttonSpinner.removeClass('hidden');
                $signInBtn.attr('disabled', true);

                $.ajax({
                    url: '/restaurant/login',
                    type: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function (jqXHR) {
                        let errorMessage = {};
                        try {
                            errorMessage = JSON.parse(jqXHR.responseText);
                        } catch (e) {
                            errorMessage.message = "Login failed. Please try again.";
                        }

                        if (jqXHR.status === 400 || jqXHR.status === 401) {
                            let errorHtml = `
                                <div id="errMessage" class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg animate__animated animate__fadeIn" role="alert">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>${errorMessage.message}</span>
                                    </div>
                                </div>
                            `;

                            if (!$('#errMessage').length) {
                                $('form').prepend(errorHtml);
                            } else {
                                $('#errMessage').replaceWith(errorHtml);
                            }

                            setTimeout(function () {
                                $('#errMessage').addClass('animate__fadeOut');
                                setTimeout(function() {
                                    $('#errMessage').remove();
                                }, 500);
                            }, 5000);
                        }
                    },
                    complete: function () {
                        $buttonText.text("Sign in");
                        $buttonSpinner.addClass('hidden');
                        $signInBtn.attr('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>