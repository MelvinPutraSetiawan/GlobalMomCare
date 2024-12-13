<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    {{-- Load Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="relative bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('/images/auth/bg.jpg');">
    <div class="absolute inset-0 bg-white opacity-40"></div>

    <div class="glass bg-white/30 rounded-lg shadow-lg flex max-w-4xl w-full overflow-hidden relative z-10">

        <div class="hidden md:flex flex-1 items-center justify-center relative">
            <div class="absolute inset-0 opacity-60" style="background-color: #d5e6ed;"></div>
            <img src="{{ asset('images/auth/login.png') }}" alt="Illustration" class="relative w-auto h-4/4 z-10">
        </div>

        <div class="w-full md:w-1/2 p-8">

            <h2 class="text-3xl font-bold text-black mt-4">Hello Again!</h2>
            <p class="text-gray-800 font-semibold">Welcome back, we're here to help!</p>

            @if ($errors->has('login_error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 mt-4">
                    <strong>{{ $errors->first('login_error') }}</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-8">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Enter email</label>
                    <input id="email" type="email" name="email" placeholder="john@gmail.com" value="{{ old('email') }}" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" name="password" placeholder="••••••••" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>

                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-gray-700">Remember Me</label>
                </div>

                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded">
                    Sign In
                </button>
            </form>

            <div class="flex mt-3">
                <span>Haven't create an account? </span>
                <span class="opacity-0">s</span>
                <a href="{{ route('register') }}" class="text-red-500 font-bold">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
