<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
{
    $kategori = Kategori::all();

    $kendaraan = Kendaraan::with('kategori');

    if ($request->kategori) {
        $kendaraan->where('kategori_id', $request->kategori);
    }

    $kendaraan = $kendaraan->latest()->get();

    return view('admin.kendaraan.index', compact('kendaraan','kategori'));
}
    

    public function create()
    {
        $kategori = Kategori::all();

        return view('admin.kendaraan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_kendaraan' => 'required',
            'harga' => 'required',
            // 'stok' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {

            $namaFoto = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('foto_kendaraan'), $namaFoto);
        }

        Kendaraan::create([
            'kategori_id' => $request->kategori_id,
            'nama_kendaraan' => $request->nama_kendaraan,
            'harga' => $request->harga,
            // 'stok' => $request->stok,
            'status' => $request->status,
            'foto' => $namaFoto,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambah kendaraan',
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kategori = Kategori::all();

        return view('admin.kendaraan.edit', compact('kendaraan', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
    
        $request->validate([
            'kategori_id' => 'required',
            'nama_kendaraan' => 'required|max:100',
            'harga' => 'required|numeric',
            // 'stok' => 'required|integer',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $namaFoto = $kendaraan->foto;
    
        if ($request->hasFile('foto')) {
    
            // Hapus foto lama (jika ada)
            if ($kendaraan->foto && file_exists(public_path('foto_kendaraan/' . $kendaraan->foto))) {
                unlink(public_path('foto_kendaraan/' . $kendaraan->foto));
            }
    
            // Upload foto baru
            $namaFoto = time() . '.' . $request->foto->extension();
    
            $request->foto->move(public_path('foto_kendaraan'), $namaFoto);
        }
    
        $kendaraan->update([
            'kategori_id' => $request->kategori_id,
            'nama_kendaraan' => $request->nama_kendaraan,
            'harga' => $request->harga,
            // 'stok' => $request->stok,
            'status' => $request->status,
            'foto' => $namaFoto,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah data kendaraan',
        ]);
    
        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diubah');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus kendaraan',
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus');
    }

    public function index_pengguna(Request $request)
{
    $kategori = Kategori::all();

    $kendaraan = Kendaraan::with('kategori');

    if ($request->kategori) {
        $kendaraan->where('kategori_id', $request->kategori);
    }

    $kendaraan = $kendaraan->latest()->get();

    return view('pengguna.kendaraan.index', compact('kendaraan','kategori'));
}
}
