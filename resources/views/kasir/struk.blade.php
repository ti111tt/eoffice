<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
</head>




<body>

<h1>Struk Pembayaran</h1>
<table border="1">
    <tr>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>
    @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->item->nama_barang }}</td>
            <td>Rp{{ number_format($item->item->harga, 2) }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp{{ number_format($item->subtotal, 2) }}</td>
        </tr>
    @endforeach
</table>

<h3>Total Harga: Rp{{ number_format($total, 2) }}</h3>
<h3>Uang Pembeli: Rp{{ number_format($bayar, 2) }}</h3>
<h3>Kembalian: Rp{{ number_format($kembalian, 2) }}</h3>

<!-- Form untuk kembali ke dashboard dan menyimpan transaksi -->
<form action="{{ route('save_transaction') }}" method="POST">
    @csrf
    <input type="hidden" name="total" value="{{ $total }}">
    <input type="hidden" name="bayar" value="{{ $bayar }}">
    <input type="hidden" name="kembalian" value="{{ $kembalian }}">
    <button type="submit" class="btn btn-primary">Kembali ke Dashboard</button>
</form>


<!-- Form untuk cetak struk PDF -->
<form action="{{ route('cart.generate_pdf') }}" method="POST" class="mt-4">
    @csrf
    <input type="hidden" name="cartItems" value="{{ json_encode($cartItems) }}">
    <input type="hidden" name="total" value="{{ $total }}">
    <input type="hidden" name="bayar" value="{{ $bayar }}">
    <input type="hidden" name="kembalian" value="{{ $kembalian }}">
    <button type="submit" class="btn btn-primary">Cetak Struk PDF</button>
</form>

</body>
</html>
