@extends('layouts.navbar')

@section('title', 'Edit Supplier')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Supplier</h2>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Supplier --}}
    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                   id="nama" name="nama" value="{{ old('nama', $supplier->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                      id="alamat" name="alamat" rows="3" required>{{ old('alamat', $supplier->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kode Pos --}}
        <div class="mb-3">
            <label for="kode_pos" class="form-label">Kode Pos</label>
            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                   id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $supplier->kode_pos) }}">
            @error('kode_pos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
