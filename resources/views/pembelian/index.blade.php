@extends('layouts.navbar')

@section('title', 'Daftar Pembelian')

@section('content')
@include('message.message')

<div class="container mt-4">
    <h2 class="mb-4">Data Pembelian</h2>

    <!-- Form Filter -->
    <form action="{{ route('pembelian.index') }}" method="GET" class="row g-2 align-items-center mb-3">
        <!-- Input tanggal dan teks s/d sejajar -->
        <div class="col-md-6">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" style="max-width: 200px;">
                <span class="mx-1">s/d</span>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" style="max-width: 200px;">
            </div>
        </div>

        <!-- Dropdown Supplier -->
        <div class="col-md-3">
            <select name="supplier_id" class="form-control">
                <option value="">-- Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Filter & Reset -->
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="{{ route('pembelian.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pembelian</a>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Tabel Data Pembelian -->
    @if($pembelians->count())
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Hin</th> <!-- Ini nomor urut -->
                    <th>Barang</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelians as $key => $item)
                    <tr>
                        <td>{{ $pembelians->firstItem() + $key }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->supplier->nama }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('pembelian.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $pembelians->appends(request()->query())->links() }}
        </div>
    </div>
    @else
        <div class="alert alert-warning">Tidak ada data pembelian.</div>
    @endif
</div>
@endsection
