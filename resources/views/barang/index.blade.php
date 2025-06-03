@extends('layouts.navbar')

@section('content')
<div class="container mt-4">
    <h2>Data Barang</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <form action="{{ route('barang.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari nama barang..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Cari</button>
    </form>

    {{-- Tombol Tambah --}}
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    {{-- Tabel Data --}}
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $item)
                <tr>
                    <td>
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" width="80" alt="gambar {{ $item->nama }}">
                        @else
                            <em>Tidak ada</em>
                        @endif
                    </td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori->nama }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada barang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $barangs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
