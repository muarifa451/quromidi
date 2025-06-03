<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sweetara')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        .navbar-custom {
            background: linear-gradient(90deg, #ff9a9e, #fad0c4);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.6rem;
            color: #343a40 !important;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            margin-left: 10px;
            transition: all 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #343a40 !important;
            background-color: rgba(255,255,255,0.3);
            border-radius: 5px;
            padding-left: 12px;
            padding-right: 12px;
        }
        .logout-link {
            background-color: #e63946;
            color: white !important;
            padding: 6px 12px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .logout-link:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body style="background-color: #fff0e6;">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('barang.index') }}">
            <i class="bi bi-shop"></i> Sweetara
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}"><i class="bi bi-box-seam"></i> Barang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kategori.index') }}"><i class="bi bi-tags"></i> Kategori</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('supplier.index') }}"><i class="bi bi-truck"></i> Supplier</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pembeli.index') }}"><i class="bi bi-people"></i> Pembeli</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pembelian.index') }}"><i class="bi bi-bag-plus"></i> Pembelian</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('penjualan.index') }}"><i class="bi bi-bag-check"></i> Penjualan</a></li>
                <li class="nav-item">
                    <a class="nav-link logout-link" href="{{ url('logout') }}">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container mt-4" style="background-color: rgba(255,255,255,0.6); padding: 20px; border-radius: 12px;">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
