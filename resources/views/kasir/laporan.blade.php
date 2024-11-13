<!-- Example: laporan.blade.php -->

<html>
<head>
    <title>Laporan Keuangan</title>
</head>
<body>
    <h1>Laporan Keuangan</h1>

    <!-- Contoh tabel transaksi -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total Harga</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ number_format($transaction->total_harga, 2) }}</td>
                <td>{{ number_format($transaction->bayar, 2) }}</td>
                <td>{{ number_format($transaction->kembalian, 2) }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol Download PDF -->
    <a href="{{ url('home/report-pdf') }}" class="btn btn-primary">Download PDF</a>
</body>
</html>
