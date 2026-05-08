<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report - SIPEDA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- LEAFLET CSS -->
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet/dist/leaflet.css"/>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

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
               class="block px-4 py-3 rounded-xl hover:bg-white/20 transition">
                Laporan
            </a>

            <a href="/reports/create"
               class="block bg-white/20 px-4 py-3 rounded-xl">
                Buat Laporan
            </a>

        </nav>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h2 class="text-4xl font-bold text-gray-800">
                Buat Laporan Baru
            </h2>

            <p class="text-gray-500 mt-2">
                Laporkan fasilitas desa yang mengalami kerusakan
            </p>

        </div>

        <!-- FORM -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">

            <form action="/reports"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-8">

                @csrf

                <!-- TITLE -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-3">
                        Judul Laporan
                    </label>

                    <input type="text"
                           name="title"
                           required
                           placeholder="Contoh: Jalan Rusak di Dusun Sukamaju"
                           class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- DESCRIPTION -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-3">
                        Deskripsi Kerusakan
                    </label>

                    <textarea name="description"
                              rows="5"
                              required
                              placeholder="Jelaskan kondisi fasilitas yang rusak..."
                              class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none"></textarea>

                </div>

                <!-- LOCATION -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-3">
                        Lokasi
                    </label>

                    <input type="text"
                           name="location"
                           required
                           placeholder="Contoh: RT 03 RW 05"
                           class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- IMAGE -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-3">
                        Upload Foto
                    </label>

                    <div class="border-2 border-dashed border-gray-300 rounded-3xl p-8 text-center hover:border-green-500 transition">

                        <input type="file"
                               name="image"
                               id="imageInput"
                               accept="image/*"
                               class="hidden">

                        <label for="imageInput"
                               class="cursor-pointer">

                            <div class="text-6xl mb-4">
                                📷
                            </div>

                            <p class="text-gray-600">
                                Klik untuk upload gambar
                            </p>

                            <p class="text-sm text-gray-400 mt-2">
                                JPG, PNG maksimal 2MB
                            </p>

                        </label>

                        <!-- PREVIEW -->
                        <div class="mt-6">
                            <img id="preview"
                                 class="hidden mx-auto rounded-2xl w-72 shadow-lg">
                        </div>

                    </div>

                </div>

                <!-- MAP -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-3">
                        Pilih Lokasi di Peta
                    </label>

                    <div id="map"
                         class="w-full h-96 rounded-3xl shadow-lg z-0"></div>

                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="lng">

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-4">

                    <a href="/reports"
                       class="px-6 py-4 rounded-2xl bg-gray-200 hover:bg-gray-300 transition">
                        Batal
                    </a>

                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl shadow-xl transition">

                        Kirim Laporan

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<!-- IMAGE PREVIEW -->
<script>

document.getElementById('imageInput').addEventListener('change', function(event) {

    const preview = document.getElementById('preview');

    const file = event.target.files[0];

    if(file) {

        preview.src = URL.createObjectURL(file);

        preview.classList.remove('hidden');

    }

});

</script>

<!-- LEAFLET JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

    // INIT MAP
    const map = L.map('map').setView([-6.914744, 107.609810], 13);

    // TILE OPENSTREETMAP
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        attribution: '&copy; OpenStreetMap contributors'

    }).addTo(map);

    // AUTO DETECT USER LOCATION
    navigator.geolocation.getCurrentPosition(function(position) {

        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;

        map.setView([userLat, userLng], 15);

    });

    let marker;

    // CLICK MAP
    map.on('click', function(e) {

        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // SET INPUT
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;

        // REMOVE OLD MARKER
        if(marker) {
            map.removeLayer(marker);
        }

        // ADD MARKER
        marker = L.marker([lat, lng]).addTo(map);

    });

</script>

</body>
</html>