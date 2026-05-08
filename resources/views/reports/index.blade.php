<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEDA - Reports</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<div class="bg-green-700 shadow-lg">

    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-bold text-white">
                SIPEDA
            </h1>

            <p class="text-green-100 text-sm">
                Sistem Pelaporan Fasilitas Desa
            </p>
        </div>

        <a href="/reports/create"
           class="bg-white text-green-700 px-5 py-3 rounded-xl font-semibold hover:bg-green-100 transition">

            + Buat Laporan

        </a>

    </div>

</div>

<!-- HERO -->
<div class="bg-gradient-to-r from-green-700 to-emerald-900 text-white py-16">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h2 class="text-5xl font-bold mb-6">
            Portal Laporan Desa
        </h2>

        <p class="text-xl text-green-100 max-w-3xl mx-auto">
            Masyarakat dapat melaporkan fasilitas desa yang rusak
            secara cepat dan transparan.
        </p>

    </div>

</div>

<!-- CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-12">

    <!-- FILTER -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-10">

        <form method="GET"
              class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- SEARCH -->
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari laporan..."
                   class="border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

            <!-- STATUS -->
            <select name="status"
                    class="border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

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
                    class="bg-green-600 hover:bg-green-700 text-white rounded-xl px-5 py-3 font-semibold transition">

                Filter

            </button>

        </form>

    </div>

    <!-- REPORT GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($reports as $report)

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">

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
                    <p class="text-gray-600 mb-5">

                        {{ Str::limit($report->description, 100) }}

                    </p>

                    <!-- INFO -->
                    <div class="space-y-2 text-gray-500 mb-5">

                        <div>
                            📍 {{ $report->location }}
                        </div>

                        <div>
                            👤 {{ $report->user->name ?? 'User' }}
                        </div>

                        <div>
                            🕒 {{ $report->created_at->diffForHumans() }}
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-between items-center">

                        <a href="/reports/{{ $report->id }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl transition">

                            Detail

                        </a>

                        @if($report->latitude && $report->longitude)

                            <a href="https://maps.google.com/?q={{ $report->latitude }},{{ $report->longitude }}"
                               target="_blank"
                               class="text-blue-600 hover:underline text-sm">

                                Maps

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @endforeach

    </div>

    <!-- PAGINATION -->
    <div class="mt-12">

        {{ $reports->links() }}

    </div>

</div>

</body>
</html>