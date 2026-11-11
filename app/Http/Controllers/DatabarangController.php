<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use Illuminate\Http\Request;

class DatabarangController extends Controller
{
    public function index()
    {
        $databarangs = Databarang::all();
        return view('admin.databarang.index', compact('databarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'ukuran_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:50',
            'detail_barang' => 'nullable|string|max:500',
        ]);

        Databarang::create([
            'nama_barang' => $request->nama_barang,
            'ukuran_barang' => $request->ukuran_barang,
            'satuan' => $request->satuan,
            'detail_barang' => $request->detail_barang,
        ]);
        return redirect()->route('databarang.index')->with('success', 'Data barang berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'ukuran_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:50',
            'detail_barang' => 'nullable|string|max:500',
        ]);

        $barang = Databarang::findOrFail($id);
        $barang->update($request->only(['nama_barang', 'ukuran_barang', 'detail_barang', 'satuan']));

        return redirect()->route('databarang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Databarang::destroy($id);
        return redirect()->route('databarang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
