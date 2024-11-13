<form action="{{ route('home.emails.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Pengirim:</label>
    <input type="email" name="sender" required><br>

    <label>Penerima:</label>
    <input type="email" name="receiver" required><br>

    <label>Subjek:</label>
    <input type="text" name="subject" required><br>

    <label>Pesan:</label>
    <textarea name="message" required></textarea><br>

    <label>Tipe Surat:</label>
    <select name="type" required>
        <option value="inbox">Surat Masuk</option>
        <option value="outbox">Surat Keluar</option>
    </select><br>

    <label>File Surat (Opsional):</label>
    <input type="file" name="file"><br>

    <button type="submit">Kirim Surat</button>
</form>
