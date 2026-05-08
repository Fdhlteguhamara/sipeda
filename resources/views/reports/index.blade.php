<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SIPEDA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-gradient-to-b from-green-700 to-emerald-900 text-white p-6 hidden lg:block">

        <h1 class="text-3xl font-bold mb-10">
            SIPEDA
        </h1>

        <nav class="space-y-4">

            <a href="/dashboard"
               class="block px-4 py-3 rounded-xl hover:bg-white/20 transition">
                Dashboard
            </a>

            <a href="/reports"
               class="block bg-white/20 px-4 py-3 rounded-xl">
                Laporan
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

            <div>
                <h2 class="text-4xl font-bold text-gray-800">
                    Laporan Fasilitas Desa
                </h2>

                <p class="text-gray-500 mt-2">
                    Monitoring laporan masyarakat
                </p>
            </div>

            <a href="/reports/create"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">
                + Tambah Laporan
            </a>

        </div>

        <!-- FILTER -->
        <div class="bg-white p-5 rounded-3xl shadow-lg mb-8">

            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- SEARCH -->
                <input type="text"
                       name="search"
                       placeholder="Cari laporan..."
                       value="{{ request('search') }}"
                       class="px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">

                <!-- STATUS -->
                <select name="status"
                        class="px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <option value="">Semua Status</option>

                    <option value="pending"
                        {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="proses"
                        {{ request('status') == 'proses' ? 'selected' : '' }}>
                        Diproses
                    </option>

                    <option value="selesai"
                        {{ request('status') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                </select>

                <!-- BUTTON -->
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white rounded-xl px-5 py-3 transition">
                    Filter
                </button>

            </form>

        </div>

        <!-- REPORT GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($reports as $report)

                <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                    <!-- IMAGE -->
                    <img src="{{ $report->image_url }}"
                         class="w-full h-56 object-cover">

                    <!-- CONTENT -->
                    <div class="p-6">

                        <!-- STATUS -->
                        <div class="mb-4">

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

                        </div>

                        <!-- TITLE -->
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">
                            {{ $report->title }}
                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="text-gray-600 mb-5 line-clamp-3">
                            {{ $report->description }}
                        </p>

                        <!-- LOCATION -->
                        <div class="flex items-center text-gray-500 mb-5">

                            📍 {{ $report->location }}

                        </div>

                        <!-- MAP -->
                        @if($report->latitude && $report->longitude)

                            <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
                               target="_blank"
                               class="inline-block text-blue-600 hover:underline mb-5">

                                Lihat di Google Maps

                            </a>

                        @endif

                        <!-- FOOTER -->
                        <div class="flex justify-between items-center">

                            <small class="text-gray-400">
                                {{ $report->created_at->diffForHumans() }}
                            </small>

                            <a href="/reports/{{ $report->id }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl transition">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        <!-- PAGINATION -->
        <div class="mt-10">
            {{ $reports->links() }}
        </div>

    </main>

</div>

</body>
</html>