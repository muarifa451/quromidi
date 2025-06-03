<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Detailpenjualan;
use App\Models\Pembelian;

class DashboardController extends Controller
{
    public function index()
    {
        // Barang dengan stok ≤ 5
        $barangStokRendah = Barang::where('stok', '<=', 5)->get();

        // Jumlah total barang
        $jumlahBarang = Barang::count();

        // Jumlah transaksi penjualan
        $jumlahPenjualan = Penjualan::count();

        // Total pendapatan dari tabel detail_penjualan
        $totalPendapatan = Detailpenjualan::sum('total_harga');

        // Kirim data ke view
        return view('dashboard', compact(
            'barangStokRendah',
            'jumlahBarang',
            'jumlahPenjualan',
            'totalPendapatan'
        ));
    }
}