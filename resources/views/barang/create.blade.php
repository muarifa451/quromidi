@extends('layouts.navbar')

@section('title', 'Tambah Barang')

@section('content')
<h2>Tambah Barang</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Barang</label>
        <input type="text" name="nama" id="nama" 
               class="form-control @error('nama') is-invalid @enderror" 
               value="{{ old('nama') }}" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" id="kategori_id" 
                class="form-control @error('kategori_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" 
                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" name="gambar" id="gambar" 
               class="form-control @error('gambar') is-invalid @enderror">
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" id="harga" 
               class="form-control @error('harga') is-invalid @enderror" 
               value="{{ old('harga') }}" required>
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
