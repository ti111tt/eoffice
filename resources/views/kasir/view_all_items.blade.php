<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
</head>
<body>

<h1>Daftar Barang</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
    </tr>
    @foreach($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->nama_barang }}</td>
        <td>Rp{{ number_format($item->harga, 2) }}</td>
        <td>{{ $item->stok }}</td>
    </tr>
    @endforeach
</table>

<h2>Input Barang</h2>
<form action="{{ route('kasir.inputBarang') }}" method="POST">
    @csrf
    <label for="kode_barang">Pilih Barang (ID):</label>
    <input type="number" name="kode_barang" required>
    <label for="quantity">Jumlah:</label>
    <input type="number" name="quantity" min="1" value="1" required>
    <button type="submit">Tambah ke Keranjang</button>
</form>

<a href="{{ route('kasir.inputKodeBarang') }}">Input Kode Barang</a>

</body>
</html>
