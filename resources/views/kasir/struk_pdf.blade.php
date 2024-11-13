<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Courier', sans-serif;
            margin: 0;
            padding-top: 0mm; /* Tambahkan padding atas agar header naik */
            padding-left: 3mm;
            padding-right: 5mm;
            width: 90mm; 
            height: 90mm; 
            font-size: 7px;
            box-sizing: border-box;
        }
       .header {
            text-align: left; /* Align the header content to the left */
            font-size: 7px;
            margin-bottom: 2px;
            line-height: 1.2;
        }
        h1 {
            font-size: 8px;
            margin: 3px 0;
        }
        .item {
            display: flex;
            justify-content: space-between;
            margin: 1px 0;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-top: 2px;
            border-top: 1px solid black;
            padding-top: 1px;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>RPL</h1>
    <p>Alamat:permata harapan</p>
    <p>Telepon: +6282280297788</p>
    <p>Tanggal: {{ date('d/m/Y') }}</p>
    <p>Transaksi #: {{ uniqid() }}</p>
</div>

<h1>Struk Pembayaran</h1>
@foreach($cartItems as $item)
    <div class="item">
        <div>{{ $item->item->nama_barang }}</div>
        <div>Rp{{ number_format($item->item->harga, 2, ',', '.') }}</div>
        <div>x {{ $item->quantity }}</div>
        <div>Rp{{ number_format($item->subtotal, 2, ',', '.') }}</div>
    </div>
@endforeach

<!-- Bagian Total -->
<div class="summary total">
    <div>Total Harga:</div>
    <div>Rp{{ number_format($total, 2, ',', '.') }}</div>
</div>
<div class="summary">
    <div>Uang Pembeli:</div>
    <div>Rp{{ number_format($bayar, 2, ',', '.') }}</div>
</div>
<div class="summary">
    <div>Kembalian:</div>
    <div>Rp{{ number_format($kembalian, 2, ',', '.') }}</div>
</div>

<div class="footer">
    <p>Terima kasih atas kunjungan Anda!</p>
</body>
</html>

