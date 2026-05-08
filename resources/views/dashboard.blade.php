<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SIPEDA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-gradient-to-b from-green-700 to-emerald-900 text-white p-6">

        <h1 class="text-3xl font-bold mb-10">
            SIPEDA
        </h1>

        <nav class="space-y-4">

            <a href="/dashboard"
               class="block bg-white/20 px-4 py-3 rounded-xl hover:bg-white/30 transition">
                Dashboard
            </a>

            <a href="/reports"
               class="block px-4 py-3 rounded-xl hover:bg-white/20 transition">
                Laporan
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-red-500 transition">
                    Logout
                </button>
            </form>

        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h2 class="text-4xl font-bold text-gray-800">
                    Dashboard SIPEDA
                </h2>

                <p class="text-gray-500 mt-2">
                    Sistem Pelaporan Fasilitas Desa
                </p>
            </div>

            <div class="bg-white px-5 py-3 rounded-2xl shadow">
                👋 {{ auth()->user()->name }}
            </div>

        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            <!-- TOTAL -->
            <div class="bg-white p-6 rounded-3xl shadow-lg">
                <p class="text-gray-500 mb-2">
                    Total Laporan
                </p>

                <h3 class="text-4xl font-bold text-green-700">
                    {{ $total }}
                </h3>
            </div>

            <!-- PENDING -->
            <div class="bg-yellow-400 text-white p-6 rounded-3xl shadow-lg">
                <p class="mb-2">
                    Pending
                </p>

                <h3 class="text-4xl font-bold">
                    {{ $pending }}
                </h3>
            </div>

            <!-- PROSES -->
            <div class="bg-blue-500 text-white p-6 rounded-3xl shadow-lg">
                <p class="mb-2">
                    Diproses
                </p>

                <h3 class="text-4xl font-bold">
                    {{ $proses }}
                </h3>
            </div>

            <!-- SELESAI -->
            <div class="bg-green-500 text-white p-6 rounded-3xl shadow-lg">
                <p class="mb-2">
                    Selesai
                </p>

                <h3 class="text-4xl font-bold">
                    {{ $selesai }}
                </h3>
            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            <div class="p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-800">
                    Laporan Terbaru
                </h3>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                    <tr>
                        <th class="p-4 text-left">Foto</th>
                        <th class="p-4 text-left">Judul</th>
                        <th class="p-4 text-left">Lokasi</th>
                        <th class="p-4 text-left">Status</th>
                    </tr>

                    </thead>

                    <tbody>

                    @foreach($reports as $report)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4">

                                <img src="{{ $report->image_url }}"
                                     class="w-20 h-20 object-cover rounded-xl">

                            </td>

                            <td class="p-4 font-semibold">
                                {{ $report->title }}
                            </td>

                            <td class="p-4 text-gray-600">
                                {{ $report->location }}
                            </td>

                            <td class="p-4">

                                @if($report->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">
                                        Pending
                                    </span>

                                @elseif($report->status == 'proses')

                                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm">
                                        Diproses
                                    </span>

                                @else

                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                                        Selesai
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>