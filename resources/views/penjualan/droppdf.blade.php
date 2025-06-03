<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Penjualan</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; }
        th, td { padding: 8px; font-size: 12px; }
    </style>
</head>
<body>
    <h2>Data Penjualan</h2>
    <table width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>{{ $p->pembeli->nama ?? '-' }}</td>
                <td>{{ $p->barang->nama ?? '-' }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>Rp{{ number_format($p->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
