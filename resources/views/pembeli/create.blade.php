@extends('layouts.navbar')

@section('content')
<div class="container mt-4">
    <h2>Tambah Pembeli</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pembeli.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP:</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pembeli.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
