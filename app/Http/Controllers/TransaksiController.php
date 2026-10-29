<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with(['user', 'kendaraan', 'petugas'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['user', 'kendaraan', 'petugas']);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus riwayat transaksi ' . $transaksi->kode_transaksi,
        ]);

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function index_petugas(Request $request)
    {
        $transaksi = Transaksi::with(['user', 'kendaraan', 'petugas'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('kode_transaksi', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q2) use ($search) {
                          $q2->where('nama', 'like', "%{$search}%");
                      })
                      ->orWhereHas('kendaraan', function ($q2) use ($search) {
                          $q2->where('nama_kendaraan', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->get();
    
        return view('petugas.transaksi.index', compact('transaksi'));
    }

    public function show_petugas($id)
    {
        $transaksi = Transaksi::with(['user', 'kendaraan'])
            ->findOrFail($id);

        return view('petugas.transaksi.show', compact('transaksi'));
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required',
        'status_pembayaran' => 'required|in:Belum Bayar,Lunas',
    ]);

    $transaksi = Transaksi::findOrFail($id);

    if ($request->status == 'Disetujui' && $transaksi->status != 'Disetujui') {
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menyetujui transaksi ' . $transaksi->kode_transaksi,
        ]);
    }

    if ($request->status_pembayaran == 'Lunas' && $transaksi->status_pembayaran != 'Lunas') {
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah status pembayaran transaksi ' . $transaksi->kode_transaksi . ' menjadi Lunas',
        ]);
    }

    $transaksi->update([
        'status' => $request->status,
        'status_pembayaran' => $request->status_pembayaran,
        'petugas_id' => auth()->id(),
    ]);

    return redirect()
        ->route('petugas.transaksi.index')
        ->with('success', 'Status berhasil diubah');
}


public function index_pengguna(Request $request)
{
    $transaksi = Transaksi::with('kendaraan')
        ->where('user_id', auth()->id())
        ->when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%{$search}%")
                  ->orWhereHas('kendaraan', function ($q2) use ($search) {
                      $q2->where('nama_kendaraan', 'like', "%{$search}%");
                  });
            });
        })
        ->latest()
        ->get();

    return view('pengguna.transaksi.index', compact('transaksi'));
}

    public function create_pengguna($id)
    {
        $kendaraan = Kendaraan::with('kategori')->findOrFail($id);

        return view('pengguna.transaksi.create', compact('kendaraan'));
    }
    public function store_pengguna(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable',
        ]);

        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        $lama = Carbon::parse($request->tanggal_pinjam)
            ->diffInDays(Carbon::parse($request->tanggal_kembali)) + 1;

        $total = $lama * $kendaraan->harga;
        Transaksi::create([
            'kode_transaksi' => 'TRX' . date('YmdHis'),
            'user_id' => auth()->id(),
            'kendaraan_id' => $kendaraan->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_sewa' => $lama,
            'total_harga' => $total,
            'status' => 'Menunggu',
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengajukan sewa kendaraan',
        ]);

        return redirect()->route('pengguna.dashboard')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }
    public function show_pengguna($id)
    {
        $transaksi = Transaksi::with('kendaraan')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pengguna.transaksi.show', compact('transaksi'));
    }
    public function batal($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->status == 'Disetujui') {
            $transaksi->status = 'Dibatalkan';
            $transaksi->save();

            LogAktivitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => 'Membatalkan Peminjaman ' . $transaksi->kode_transaksi,
            ]);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan.');
    }
    public function cetak($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'user'])
            ->findOrFail($id);

        return view('pengguna.transaksi.cetak', compact('transaksi'));
    }
    public function cetak_petugas($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'user'])
            ->findOrFail($id);
    
        return view('pengguna.transaksi.cetak', compact('transaksi'));
    }
}
