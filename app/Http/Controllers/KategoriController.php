<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
        
    }

    // Simpan kategori
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100',
        ]);
    
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambah data Kategori',
        ]);
        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
    
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
    
        $request->validate([
            'nama_kategori' => 'required|max:100',
        ]);
    
        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];
        $kategori->update($data);
    
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah data Kategori',
        ]);
        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diubah');
    }

    // Hapus kategori
    public function destroy($id)
{
    $kategori = Kategori::findOrFail($id);
    $kategori->delete();
    LogAktivitas::create([
        'user_id' => auth()->id(),
        'aktivitas' => 'Menghapus data Kategori',
    ]);
    return redirect()->route('admin.kategori.index')
        ->with('success', 'Kategori berhasil dihapus');
}
}