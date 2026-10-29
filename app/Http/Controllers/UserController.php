<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.user.create');
    }

    // Simpan user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,pengguna',
        ]);

        User::create([
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambah data User',
        ]);
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:100',
            'role' => 'required|in:admin,petugas,pengguna',
        ]);

        $data = [
            'nama' => $request->nama,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah data User',
        ]);
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diubah');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus data User',
        ]);
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus');
    }
}
