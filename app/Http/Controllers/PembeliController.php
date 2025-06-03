<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembeli::query();


        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $pembelis = $query->paginate(2);
        return view('pembeli.index', compact('pembelis'));
    }


    public function create()
    {
        return view('pembeli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|unique:pembelis,no_hp|max:15',
        ]);

        Pembeli::create($request->all());

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Pembeli $pembeli)
    {
        return view('pembeli.edit', compact('pembeli'));
    }

    public function update(Request $request, Pembeli $pembeli)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|unique:pembelis,no_hp,' . $pembeli->id . '|max:15',
        ]);

        $pembeli->update($request->all());

        return redirect()->route('pembeli.index')->with('success', 'Data pembeli berhasil diperbarui.');
    }

    public function destroy(Pembeli $pembeli)
    {
        $pembeli->delete();
        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil dihapus!');
    }
}
