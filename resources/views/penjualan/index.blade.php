@extends('layouts.navbar')

@section('title', 'Daftar Penjualan')

@section('content')
@include('message.message')

<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex bd-highlight">
            <div class="p-2 bd-highlight">
                <h5>Data Penjualan</h5>
            </div>
            <div class="ms-auto p-2 bd-highlight d-flex">
                {{-- Form pencarian --}}
                <form action="{{ route('penjualan.index') }}" method="GET" class="me-2 d-flex">
                    <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari penjualan..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Cari</button>
                </form>

                {{-- Tombol Ekspor dan Tambah --}}
                <a href="{{ route('penjualan.pdf') }}" class="btn btn-danger btn-sm me-2">
                    ⬇ Drop PDF
                </a>
                <a class="btn btn-primary btn-sm" href="{{ url('penjualan/create') }}">
                    <i class="fa fa-plus"></i> Tambah Penjualan
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kasir</th>
                    <th>Pembeli</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($penjualans->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data penjualan.</td>
                    </tr>
                @else
                    @foreach ($penjualans as $d => $r)
                        <tr>
                            <td>{{ $d + $penjualans->firstItem() }}</td>
                            <td>{{ $r->kasir->username }}</td>
                            <td>{{ $r->pembeli->nama }}</td>
                            <td>{{ $r->tanggal_pesan }}</td>
                            <td>
                                <a href="{{ route('penjualan.show', $r->id) }}" class="btn btn-info btn-sm mb-1">
                                    Detail
                                </a>
                                <form action="{{ url('penjualan/'.$r->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <input onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" 
                                           type="submit" class="btn btn-danger btn-sm" value="Hapus">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="card-footer">
        {{ $penjualans->appends(request()->query())->links() }}
    </div>
</div>
@endsection
