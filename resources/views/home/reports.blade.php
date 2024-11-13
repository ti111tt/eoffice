<form action="{{ route('home.reports.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Judul Laporan:</label>
    <input type="text" name="title" required><br>

    <label>Isi Laporan:</label>
    <textarea name="content" required></textarea><br>

    <label>Kategori:</label>
    <select name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select><br>

    <label>File Laporan (Opsional):</label>
    <input type="file" name="file"><br>

    <button type="submit">Simpan Laporan</button>
</form>
