@extends('layouts.navbar')

@section('title', 'Daftar Kategori')

@section('content')
<div class="container mt-4">
    <h2>Data Kategori</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>

        <form action="{{ route('kategori.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($kategori->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $kategori->appends(request()->query())->links() }}
        </div>
        <form action="{{ route('kategori.index') }}" method="GET" class="mb-3 d-flex" role="search">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </form>
        
    @else
        <div class="text-muted">Tidak ada data kategori.</div>
    @endif
</div>
@endsection
