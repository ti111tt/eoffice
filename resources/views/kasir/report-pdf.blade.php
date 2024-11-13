<!-- resources/views/report-pdf.blade.php -->

<html>
<head>
    <title>Financial Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Financial Report</h1>

    <h2>Totals</h2>
    <p>Total this month: {{ number_format($totalCurrentMonth, 2) }}</p>
    <p>Total last month: {{ number_format($totalLastMonth, 2) }}</p>

    <h3>Transactions</h3>
    <table>
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
</body>
</html>
