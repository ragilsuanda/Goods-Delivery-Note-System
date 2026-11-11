<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center relative">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div> 

    <div class="relative w-full max-w-md bg-white bg-opacity-30 backdrop-blur-lg p-8 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Login</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-white">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
            </div>

            <!-- Password dengan ikon mata -->
            <div class="mb-4 relative">
                <label for="password" class="block text-white">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
                <button type="button" onclick="togglePassword('password', this)"
                        class="absolute top-9 right-3 text-gray-600">
                    <i class="fa-solid fa-eye-slash"></i>
                </button>
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition shadow-md">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script>
      function togglePassword(inputId, el) {
        const input = document.getElementById(inputId);
        const icon = el.querySelector('i');
        if (input.type === "password") {
          input.type = "text";
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        } else {
          input.type = "password";
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        }
      }
    </script>
</body>
</html>
