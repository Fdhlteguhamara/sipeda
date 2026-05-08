<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report->title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet/dist/leaflet.css"/>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-8">

    <!-- BACK -->
    <a href="/reports"
       class="inline-block mb-6 text-green-700 hover:underline">

        ← Kembali ke laporan

    </a>

    <!-- CARD -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- IMAGE -->
        <img src="{{ $report->image_url }}"
             class="w-full h-[500px] object-cover">

        <!-- CONTENT -->
        <div class="p-8">

            <!-- STATUS -->
            <div class="mb-5">

                @if($report->status == 'pending')

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                        Pending
                    </span>

                @elseif($report->status == 'proses')

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
                        Diproses
                    </span>

                @else

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                        Selesai
                    </span>

                @endif

            </div>

            <!-- TITLE -->
            <h1 class="text-5xl font-bold text-gray-800 mb-6">
                {{ $report->title }}
            </h1>

            <!-- META -->
            <div class="flex flex-wrap gap-6 text-gray-500 mb-8">

                <div>
                    📍 {{ $report->location }}
                </div>

                <div>
                    🕒 {{ $report->created_at->diffForHumans() }}
                </div>

                <div>
                    👤 {{ $report->user->name }}
                </div>

            </div>

            <!-- DESCRIPTION -->
            <div class="text-gray-700 leading-relaxed text-lg mb-10">

                {{ $report->description }}

            </div>

            <!-- MAP -->
            @if($report->latitude && $report->longitude)

                <div>

                    <h3 class="text-2xl font-bold mb-4">
                        Lokasi Laporan
                    </h3>

                    <div id="map"
                         class="w-full h-[400px] rounded-3xl"></div>

                </div>

            @endif

        </div>

    </div>

</div>

<!-- LEAFLET -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@if($report->latitude && $report->longitude)

<script>

    const map = L.map('map').setView([
        {{ $report->latitude }},
        {{ $report->longitude }}
    ], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        attribution: '&copy; OpenStreetMap contributors'

    }).addTo(map);

    L.marker([
        {{ $report->latitude }},
        {{ $report->longitude }}
    ]).addTo(map);

</script>

@endif

</body>
</html>