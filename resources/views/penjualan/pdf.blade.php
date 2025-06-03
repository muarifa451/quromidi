<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #eee;
        }
        th, td {
            padding: 8px;
            font-size: 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Data Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kasir</th>
                <th>Pembeli</th>
                <th>Tanggal</th>
                <th>Detail Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $i => $penjualan)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $penjualan->kasir->username }}</td>
                    <td>{{ $penjualan->pembeli->nama }}</td>
                    <td>{{ $penjualan->tanggal_pesan }}</td>
                    <td>
                        <ul style="margin: 0; padding-left: 16px;">
                            @foreach ($penjualan->detailPenjualans as $detail)
                                <li>{{ $detail->barang->nama }} - {{ $detail->jumlah }} x Rp{{ number_format($detail->total_harga, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
