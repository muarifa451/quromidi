@extends('layouts.navbar')

@section('title', 'Detail Penjualan')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h5>Detail Penjualan</h5>
    </div>
    <div class="card-body">
        <p><strong>Nama Kasir:</strong> {{ $penjualan->kasir->username ?? '-' }}</p>
        <p><strong>Nama Pembeli:</strong> {{ $penjualan->pembeli->nama ?? '-' }}</p>
        <p><strong>Tanggal Pesan:</strong> {{ $penjualan->tanggal_pesan }}</p>

        <hr>

        <h6>Barang yang Dibeli:</h6>
        @if ($penjualan->detailPenjualans->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                @endphp
                @foreach ($penjualan->detailPenjualans as $index => $detail)
                    @php
                        $harga = $detail->barang->harga ?? 0;
                        $total = $detail->total_harga;
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->barang->nama ?? '-' }}</td>
                        <td>Rp{{ number_format($harga, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-end">Total Keseluruhan</th>
                    <th>Rp{{ number_format($grandTotal, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
        @else
            <p class="text-muted">Tidak ada barang dalam penjualan ini.</p>
        @endif

        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>
</div>
@endsection
