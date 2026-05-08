<form action="/reports" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Judul"><br>
    <textarea name="description" placeholder="Deskripsi"></textarea><br>
    <input type="text" name="location" placeholder="Lokasi"><br>
    <input type="file" name="image"><br>
    <button type="submit">Kirim</button>
</form>