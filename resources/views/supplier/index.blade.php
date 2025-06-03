@extends('layouts.navbar')

@section('title', 'Daftar Supplier')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Data Supplier</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <form action="{{ route('supplier.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari supplier..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary">Cari</button>
    </form>

    {{-- Tombol Tambah Supplier --}}
    <div class="mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Tambah Supplier</button>
    </div>

    {{-- List Supplier --}}
    @if($suppliers->count())
        <ul class="list-group">
            @foreach($suppliers as $supplier)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $supplier->nama }}</strong><br>
                        <small>{{ $supplier->alamat }}</small><br>
                        <small>{{ $supplier->kode_pos ?? '-' }}</small>
                    </div>
                    <div>
                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus supplier ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">Tidak ada data supplier.</p>
    @endif

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $suppliers->appends(request()->query())->links() }}
    </div>
</div>

{{-- Modal Form Tambah Supplier --}}
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupplierModalLabel">Tambah Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kode_pos" class="form-label">Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
