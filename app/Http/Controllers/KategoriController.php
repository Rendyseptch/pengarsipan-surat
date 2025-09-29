<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        if($request->filled('search')){
            $kategoris = Kategori::where('nama_kategori', 'like', '%' . $request->search . '%')->get();
        }       
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_kategori = Kategori::count() + 1;
        if ($id_kategori <= 1) {
            $id_kategori = 1;
        }
        return view('kategori.create', compact('id_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valiated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'required|string',
        ]);

        Kategori::create([
            'nama_kategori' => $valiated['nama_kategori'],
            'keterangan' => $valiated['keterangan'],
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'required|string',
        ]);

        $kategoriUpdate = [
            'nama_kategori' => $validated['nama_kategori'],
            'keterangan' => $validated['keterangan'],
        ];

        $kategori->update($kategoriUpdate);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori = Kategori::findOrFail($kategori->id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
