<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');

        }

        $suppliers = $query->paginate(2);
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:suppliers,nama',
            'alamat' => 'required',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        Supplier::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required|unique:suppliers,nama,' . $supplier->id,
            'alamat' => 'required',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        $supplier->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}
