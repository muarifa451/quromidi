@extends('layouts.navbar')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #fef8f8;
        color: #333;
    }

    .dashboard-container {
        max-width: 1100px;
        margin: auto;
        padding: 2rem;
    }

    .welcome-box {
        background: #fff0f3;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .welcome-box img {
        width: 100px;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 3px solid #fff;
        box-shadow: 0 0 10px rgba(255, 105, 135, 0.3);
    }

    .welcome-box h2 {
        color: #e75480;
        font-weight: 600;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        transition: 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.08);
    }

    .stat-card i {
        font-size: 26px;
        margin-bottom: 10px;
    }

    .stat-title {
        font-size: 14px;
        color: #999;
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 20px;
        font-weight: 600;
    }

    .table-box {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    }

    .table thead {
        background-color: #ffe6ea;
    }

    .table td, .table th {
        vertical-align: middle;
    }
</style>

<div class="dashboard-container">
    {{-- Welcome --}}
    <div class="welcome-box">
        <img src="{{ asset('images/logo.jpg') }}" alt="Sweetara Logo">
        <h2>Selamat Datang di Sweetara!</h2>
        <p class="text-muted">Manajemen stok dan transaksi kini lebih modern dan praktis ✨</p>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">
        <div class="stat-card text-success">
            <i class="fas fa-wallet text-success"></i>
            <div class="stat-title">Total Pendapatan</div>
            <div class="stat-value">Rp 0</div>
        </div>
        <div class="stat-card text-primary">
            <i class="fas fa-boxes text-primary"></i>
            <div class="stat-title">Jumlah Barang</div>
            <div class="stat-value">4</div>
        </div>
        <div class="stat-card text-warning">
            <i class="fas fa-shopping-cart text-warning"></i>
            <div class="stat-title">Total Penjualan</div>
            <div class="stat-value">0</div>
        </div>
        <div class="stat-card text-danger">
            <i class="fas fa-exclamation-triangle text-danger"></i>
            <div class="stat-title">Stok Rendah</div>
            <div class="stat-value">0 Barang</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-box">
        <h5><i class="fas fa-box-open text-danger"></i> Barang dengan Stok Rendah (≤ 5)</h5>
        <div class="table-responsive mt-3">
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="text-danger">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">Semua stok aman 🎉</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
