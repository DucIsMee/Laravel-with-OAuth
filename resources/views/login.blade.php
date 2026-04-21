<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-br from-gray-100 to-gray-200">

<div class="bg-white p-8 rounded-2xl shadow-xl w-80 text-center transform transition duration-300 hover:scale-105">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Login
    </h1>

    @if(session('error'))
        <p class="text-red-500 mb-4">{{ session('error') }}</p>
    @endif

    <a href="/auth/google"
        class="flex items-center gap-2 bg-red-500 text-white py-2 rounded-lg mb-3
            shadow-md hover:shadow-lg hover:bg-red-600 transition duration-300">
        <i class="fa-brands fa-google ml-10"></i>
        Login with Google
    </a>

    <a href="/auth/facebook"
        class="flex items-center gap-2 bg-blue-600 text-white py-2 rounded-lg
            shadow-md hover:shadow-lg hover:bg-blue-700 transition duration-300">
        <i class="fa-brands fa-facebook ml-10"></i>
        Login with Facebook
    </a>

</div>

</body>
</html>