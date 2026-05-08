<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPEDA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT SIDE -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-green-600 to-emerald-800 text-white items-center justify-center p-12">

        <div>
            <h1 class="text-5xl font-bold mb-6">
                SIPEDA
            </h1>

            <p class="text-xl leading-relaxed mb-8">
                Sistem Pelaporan Fasilitas Desa untuk membantu masyarakat melaporkan fasilitas rusak dengan cepat dan mudah.
            </p>

            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png"
                 class="w-64 opacity-90"
                 alt="report">
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex w-full lg:w-1/2 items-center justify-center p-8">

        <div class="w-full max-w-md bg-white shadow-2xl rounded-3xl p-10">

            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold text-gray-800">
                    Selamat Datang
                </h2>

                <p class="text-gray-500 mt-2">
                    Login ke akun SIPEDA
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div class="mb-5">
                    <label class="block text-gray-700 mb-2">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           required
                           autofocus
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- PASSWORD -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">
                        Password
                    </label>

                    <input type="password"
                           name="password"
                           required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between mb-6">

                    <label class="flex items-center">
                        <input type="checkbox"
                               name="remember"
                               class="rounded border-gray-300 text-green-600 shadow-sm">

                        <span class="ml-2 text-gray-600 text-sm">
                            Remember me
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:underline"
                           href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 transition duration-300 text-white py-3 rounded-xl font-semibold text-lg shadow-lg">
                    Login
                </button>

                <!-- REGISTER -->
                <p class="text-center text-gray-500 mt-6">
                    Belum punya akun?

                    <a href="{{ route('register') }}"
                       class="text-green-600 font-semibold hover:underline">
                        Daftar
                    </a>
                </p>

            </form>

        </div>

    </div>

</div>

</body>
</html>