<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laporan</title>
</head>
<body>

<h1>Daftar Laporan SIPEDA</h1>

<a href="/reports/create">+ Buat Laporan</a>

<hr>

@foreach($reports as $report)
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3>{{ $report->title }}</h3>
        <p>{{ $report->description }}</p>
        <p><b>Lokasi:</b> {{ $report->location }}</p>
        <p><b>Status:</b> {{ $report->status }}</p>
    </div>
@endforeach

</body>
</html>