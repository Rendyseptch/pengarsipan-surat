<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Surat::with('kategori');
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        $surats = $query->get();

        return view('dashboard', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriSurat = Kategori::all(['id', 'nama_kategori']);
        return view('surat.create', compact('kategoriSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:50|unique:surats,nomor_surat',
            'judul' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategoris,id',
            'file_path' => 'required|mimes:pdf|max:2048',
        ]);

        // jangan lupa benerin jangan di taruh di public. nanti semua orang bisa akses. taruh di private storage
        // $path = $request->file('file_path')->store('surats', 'public');
        $path = $request->file('file_path')->store('surats');

        Surat::create([
            'nomor_surat' => $validated['nomor_surat'],
            'judul' => $validated['judul'],
            'kategori_id' => $validated['kategori_id'],
            'file_path' => $path

        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Surat $surat)
    {
        $surat = Surat::with('kategori')->findOrFail($surat->id);
        return view('surat.show', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surat $surat)
    {
        $surat = Surat::with('kategori')->findOrFail($surat->id);
        $kategoris = Kategori::all(['id', 'nama_kategori']);
        return view('surat.edit', compact('surat', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Surat $surat)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:50|unique:surats,nomor_surat,' . $surat->id,
            'judul' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategoris,id',
            'file_path' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            if ($surat->file_path && Storage::exists($surat->file_path)) {
                Storage::delete($surat->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('surats');
        }

        $surat->update($validated);


        return redirect()->route('surat.show', $surat->id)->with('success', 'Surat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surat $surat)
    {
        if ($surat->file_path && Storage::exists($surat->file_path)) {
            Storage::delete($surat->file_path);
        }
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }

    public function download(Surat $surat)
    {
        if (!$surat->file_path || !Storage::exists($surat->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // return response()->download(storage_path('app/' . $surat->file_path), $surat->judul . '.pdf');
        return response()->download(Storage::path($surat->file_path), $surat->judul . '.pdf');
    }

    public function export()
    {
        $surats = Surat::with('kategori')->get();

        $csvData = "Nomor Surat,Judul,Kategori,Tanggal Rilis,User\n";

        foreach ($surats as $surat) {
            $judul = $this->escapeForCsv($surat->judul);
            $kategori = $this->escapeForCsv($surat->kategori->nama_kategori);
            $tanggalRilis = $surat->created_at->format('Y-m-d');
            $username = Auth::user()->name;

            $csvData .= "{$surat->nomor_surat},\"{$judul}\",\"{$kategori}\",\"{$tanggalRilis}\",\"{$username}\",\n";
        }

        $fileName = 'surat_export_' . date('Ymd_His') . '.csv';

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$fileName}");
    }

    private function escapeForCsv($value)
    {
        if (preg_match('/^[-=+@]/', $value)) {
            return "'" . $value;
        }
        return $value;
    }

    public function stream(Surat $surat)
    {
        if (!$surat->file_path || !Storage::exists($surat->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return response()->file(Storage::path($surat->file_path));
    }
}
