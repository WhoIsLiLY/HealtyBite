<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-800 text-white">
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-green-400 to-blue-500">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <!-- Success Tabs -->
            @if (session('success'))
                <div class="mb-4 px-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Sukses! </strong><span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Login</h2>
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold  text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-gray-800"
                        required>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-gray-800"
                        required>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" id="loginButton"
                        class="w-full py-3 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 transition duration-300">
                        Sign in
                    </button>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center text-sm">
                    <a href="/" class="text-green-600 hover:underline">Login as a Customer?</a>
                </div>

                <!-- Register Link -->
                <div class="text-center text-sm mt-2">
                    <a href="{{ route('admin.register') }}" class="text-blue-600 hover:underline">Don't have an
                        account? Register here.</a>
                </div>
            </form>
        </div>
    </div>
</body>

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
            var originalText = $signInBtn.html();

            $signInBtn.html(`
                <svg class="animate-spin h-5 w-5 mx-auto text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
                </svg>
            `).attr('disabled', true);

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
                    console.log(response);
                    window.location.href = response.redirect_url;
                },
                error: function (jqXHR) {
                    if (jqXHR.responseText) {
                        console.error(jqXHR.responseText);
                    }
                    let errorMessage = {};
                    try {
                        errorMessage = JSON.parse(jqXHR.responseText);
                    } catch (e) {
                        errorMessage.message = "Login failed. Please try again.";
                    }

                    if (jqXHR.status === 400 || jqXHR.status === 401) {
                        let errorHtml = `
                            <div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">${errorMessage.message}</span>
                            </div>
                        `;

                        if (!$('#errMessage').is(':visible')) {
                            $('form').prepend(errorHtml);
                            setTimeout(function () {
                                $('#errMessage').fadeOut('slow', function () {
                                    $(this).remove();
                                });
                            }, 4000);
                        }
                    }
                },
                complete: function () {
                    $signInBtn.html(originalText).attr('disabled', false);
                }
            });
        });
    });
</script>

</html>