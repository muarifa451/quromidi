<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
    $query = Kategori::query();

    if ($request->has('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $kategori = $query->paginate(1);
    return view('kategori.index', compact('kategori'));
    }


    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama' => 'required|unique:kategoris,nama'
    ]);

    Kategori::create($request->only('nama'));

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['nama' => 'required|unique:kategoris,nama,'.$kategori->id]);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
