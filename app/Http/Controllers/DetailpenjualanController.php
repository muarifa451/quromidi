<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Barang;
use Illuminate\Http\Request;

class DetailpenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = DetailPenjualan::with(['barang', 'penjualan.pembeli']);

        // Filter berdasarkan pencarian barang atau pembeli
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })->orWhereHas('penjualan.pembeli', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $detailPenjualans = $query->paginate(10);

        return view('detailpenjualan.index', compact('detailPenjualans'));
    }

    // Menampilkan form untuk menambah detail penjualan
    public function create()
    {
        $penjualans = Penjualan::with('pembeli')->get();
        $barangs = Barang::all();
        return view('detailpenjualan.create', compact('penjualans', 'barangs'));
    }

    // Menyimpan detail penjualan ke database
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);
    
        // Ambil data harga barang dari database
        $barang = Barang::findOrFail($request->barang_id);
        $total_harga = $barang->harga * $request->jumlah;
    
        // Simpan ke tabel detailpenjualans
        DetailPenjualan::create([
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
        ]);
    
        return redirect()->route('detailpenjualan.index')->with('success', 'Detail penjualan berhasil ditambahkan!');
    }

    // Menampilkan detail penjualan tertentu (biasanya digunakan untuk show)
    public function show(string $id)
    {
        //
    }

    // Menampilkan form untuk mengedit detail penjualan
    public function edit($id)
    {
        $detail = DetailPenjualan::findOrFail($id); 
        $barangs = Barang::all(); 
        $penjualans = Penjualan::with('pembeli')->get();
    
        // Cek apakah data detail_penjualan benar
        // dd($detailpenjualan);
    
        return view('detailpenjualan.edit', compact('detail', 'barangs', 'penjualans'));
    }

    // Memperbarui data detail penjualan
    public function update(Request $request, DetailPenjualan $detailPenjualan)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $detailPenjualan->update($request->all());

        return redirect()->route('detailpenjualan.index')->with('success', 'Detail penjualan berhasil diperbarui!');
    }

    // Menghapus data detail penjualan
    public function destroy(DetailPenjualan $detailPenjualan)
    {
        $detailPenjualan->delete();
        return redirect()->route('detailpenjualan.index')->with('success', 'Detail penjualan berhasil dihapus!');
    }
}
