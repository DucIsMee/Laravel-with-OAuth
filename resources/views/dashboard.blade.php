<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-xl text-center
            transform transition duration-300 hover:shadow-2xl">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Thông tin sinh viên
    </h1>

    <div class="flex justify-center">
        <img src="{{ auth()->user()->avatar }}"
            class="w-24 h-24 rounded-full shadow-md border-4 border-white
                    transform transition duration-300 hover:scale-110">
    </div>

    <div class="mt-6 space-y-3 text-left">
        <p class="bg-gray-100 p-3 rounded-lg shadow-sm">
            <span class="font-semibold text-gray-600">Họ tên:</span>
            <span class="text-gray-800">{{ auth()->user()->name }}</span>
        </p>

        <p class="bg-gray-100 p-3 rounded-lg shadow-sm">
            <span class="font-semibold text-gray-600">Email:</span>
            <span class="text-gray-800">{{ auth()->user()->email }}</span>
        </p>

        <p class="bg-gray-100 p-3 rounded-lg shadow-sm">
            <span class="font-semibold text-gray-600">MSSV:</span>
            <span class="text-gray-800">{{ auth()->user()->student_id }}</span>
        </p>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            class="mt-6 w-full bg-red-500 text-white py-2 rounded-lg shadow-md
                hover:bg-red-600 hover:shadow-lg transition duration-300">
            Logout
        </button>
    </form>

</div>

</body>
</html>