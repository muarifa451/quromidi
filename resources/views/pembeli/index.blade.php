@extends('layouts.navbar')

@section('content')
<div class="container mt-4">
    <h2>Data Pembeli</h2>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <form action="{{ route('pembeli.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari pembeli..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </form>

    {{-- Tombol Tambah Pembeli --}}
    <a href="{{ route('pembeli.create') }}" class="btn btn-primary mb-3">Tambah Pembeli</a>

    {{-- Tabel Pembeli --}}
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelis as $pembeli)
                <tr>
                    <td>{{ $pembeli->nama }}</td>
                    <td>{{ $pembeli->jenis_kelamin }}</td>
                    <td>{{ $pembeli->alamat }}</td>
                    <td>{{ $pembeli->no_hp }}</td>
                    <td>
                        <a href="{{ route('pembeli.edit', $pembeli->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pembeli.destroy', $pembeli->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pembeli ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data pembeli.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $pembelis->appends(request()->query())->links() }}
    </div>
</div>
@endsection
