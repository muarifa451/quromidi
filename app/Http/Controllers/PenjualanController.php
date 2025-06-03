<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pembeli', 'kasir', 'detailPenjualans')->paginate(2);
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        $pembelis = Pembeli::all();
        return view('penjualan.create', compact('barangs', 'pembelis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembeli_id' => 'required|exists:pembelis,id',
            'barang_idnya' => 'required|array',
            'barang_idnya.*' => 'required|exists:barangs,id',
            'jumlahdibeli' => 'required|array',
            'jumlahdibeli.*' => 'required|integer|min:1',
            'totaldibeli' => 'required|array',
            'totaldibeli.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $penjualan = Penjualan::create([
                'pembeli_id' => $request->pembeli_id,
                'kasir_id' => session('idyangmasuk'),
                'tanggal_pesan' => date("Y-m-d"),
            ]);

            foreach ($request->barang_idnya as $index => $barang_id) {
                $barang = Barang::findOrFail($barang_id);
                $jumlah = $request->jumlahdibeli[$index];
                $total = $request->totaldibeli[$index];

                if ($barang->stok < $jumlah) {
                    throw new \Exception("Stok barang '{$barang->nama}' tidak mencukupi.");
                }

                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah,
                    'total_harga' => $total,
                ]);

                $barang->stok -= $jumlah;
                $barang->save();
            }

            DB::commit();
            Session::flash('pesan', 'Data penjualan berhasil ditambahkan');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('penjualan.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $penjualan = Penjualan::findOrFail($id);
            foreach ($penjualan->detailPenjualans as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang) {
                    $barang->stok += $detail->jumlah;
                    $barang->save();
                }
                $detail->delete();
            }

            $penjualan->delete();

            DB::commit();
            Session::flash('pesan', 'Data penjualan berhasil dihapus');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('penjualan.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('penjualan.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ✅ Export PDF
    public function exportPDF()
    {
        $penjualans = Penjualan::with('pembeli', 'detailPenjualans.barang')->get();
        $pdf = Pdf::loadView('penjualan.pdf', compact('penjualans'));
        return $pdf->download('data-penjualan.pdf');
    }

    // ✅ Tampilkan Detail Penjualan
    public function show($id)
    {
        $penjualan = Penjualan::with(['pembeli', 'kasir', 'detailPenjualans.barang'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }
}
